<?php 

declare(strict_types=1);

namespace DiegoBrocanelli\Gravatar;

/**
 * @author Diego Brocanelli <diegod2@msn.com>
 */
class Gravatar
{
    const IMAGE_SET_LIST      = [ '404', 'mm', 'identicon', 'monsterid', 'wavatar' ];
    const MAXIMUM_RATING_LIST = [ 'g', 'pg', 'r', 'x' ];
    const ATTRIBUTES_LIST     = [
        'alt', 
        'crossorigin', 
        'height', 
        'ismap', 
        'loading', 
        'longdesc', 
        'referrerpolicy', 
    ];

    const URL_GRAVATAR = 'https://www.gravatar.com/avatar/';

    /**
     * @var string Email configured on Gravatar
     */
    protected string $email;

    /**
     * Size in pixels, defaults to 80px [ 1 - 2048 ]
     * 
     * @param int $imageSize
     */
    protected int $imageSize = 80;

    /**
     * Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * 
     * @var string
     */
    protected string $imageSet = 'mm';

    /**
     * Maximum rating (inclusive) [ g | pg | r | x ]
     * 
     * @var string
     */
    protected string $maximumRating = 'g';

    /**
     * Optional, additional key/value attributes to include in the IMG tag
     * 
     * @var array 
     */
    protected array $imageAttributes;

    /**
     * @var string $email Email registered in Gravatar
     */
    public function __construct( string $email)
    {
        if( filter_var($email, FILTER_VALIDATE_EMAIL) === false )
        {
           throw new \InvalidArgumentException("Email '{$email}' entered is invalid.");
        }

        $sanitizeEmail = md5( strtolower( trim( $email ) ) );

        $this->email   = $sanitizeEmail;
    }

    /**
     * Return image url
     * 
     * @return string
     */
    public function buildURL(): string
    {
        $url  = $this->getUrlGravatarBase();
        $url .= $this->getEmail();      
        $url .= "?s={$this->getImageSize()}";
        $url .= "&d={$this->getImageSet()}";
        $url .= "&r={$this->getMaxRating()}";

        return $url;
    }

    /**
     * Returns the ready to use img tag 
     * 
     * @return string
     */
    public function buildImage(): string
    {
        $url = $this->buildURL();

        $image = "<img src='{$url}'";

        foreach ($this->getAttributes() as $key => $value) {
            $image .= ' ' . $key . '="'.$value.'"';
        }

        $image .= '/>';

        return $image;
    }

    /**
     * Size in pixels
     * 
     * defaults to 80px [ 1 - 2048 ]
     * 
     * @param integer $size
     * @return void
     */
    public function setImageSize(int $size): void
    {
        if($size <= 0 || $size >= 2049){
            throw new \InvalidArgumentException("Size '{$size}' entered is invalid.");
        }

        $this->imageSize = $size;
    }

    /**
     * @return integer
     */
    public function getImageSize(): int
    {
        return $this->imageSize;
    }


    /**
     * Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * 
     * @param string $value
     * @return void 
     */
    public function setImageSet(string $value): void
    {
        $value = trim($value);
        $value = strip_tags($value);

        if( !in_array($value, self::IMAGE_SET_LIST) ){
            throw new \InvalidArgumentException("invalid value '{$value}'.");
        }
        
        $this->imageSet = $value;
    }

    /**
     * Return set value
     *
     * @return string
     */
    public function getImageSet(): string
    {
        return $this->imageSet;
    }

    /**
     * Maximum rating (inclusive) [ g | pg | r | x ]
     *
     * @param string $maxRating
     * @return void
     */
    public function setMaxRating( string $maxRating): void
    {
        $maxRating = trim($maxRating);
        $maxRating = strip_tags($maxRating);

        if( !in_array($maxRating, self::MAXIMUM_RATING_LIST) ){
            throw new \InvalidArgumentException("invalid value '{$maxRating}'.");
        }

        $this->maximumRating = $maxRating;
    }

    /**
     * Return max rating value
     *
     * @return string
     */
    public function getMaxRating(): string
    {
        return $this->maximumRating;
    }

    /**
     * Set image configuration options
     *
     * @param string $attribute
     * @param string $value
     * @return void
     */
    public function setImageAttribute(string $attribute, string $value): void
    {
        $attribute = strip_tags( trim($attribute) );
        $value     = strip_tags( trim($value) );

        if( !in_array($attribute, self::ATTRIBUTES_LIST) ){
            throw new \InvalidArgumentException("Option '{$attribute}' does not exist, please inform a valid option.");
        }

        $this->imageAttributes[$attribute] = $value;
    }

    /**
     * Returns the value of the attribute
     *
     * @return string
     */
    public function getAttribute(string $attribute): string
    {
        $attribute = strip_tags( trim($attribute) );

        if( !in_array($attribute, self::ATTRIBUTES_LIST) ){
            throw new \InvalidArgumentException("Desired attribute '{$attribute}' does not exist..");
        }

        return $this->imageAttributes[$attribute];
    }


    /**
     * Returns the list of configured attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->imageAttributes;
    }

    /**
     * Returns the configured email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Returns the email from the Gravatar API
     *
     * @return string
     */
    public function getUrlGravatarBase(): string
    {
        return self::URL_GRAVATAR;
    }
}
