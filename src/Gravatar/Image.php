<?php

namespace DiegoBrocanelli\Gravatar;

use DiegoBrocanelli\Gravatar\ImageInterface;

/**
 * @author Diego Brocanelli <diegod2@msn.com>
 */
class Image implements ImageInterface
{
    /**
     * @var string URL base for search 
     */
    protected $urlGravatar = 'https://www.gravatar.com/avatar/';

    /**
     * @var string Email configured on Gravatar
     */
    protected $email;

    /**
     * Size in pixels, defaults to 80px [ 1 - 2048 ]
     * 
     * @var string
     */
    protected $imageSize = 80;

    /**
     * Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * 
     * @var string
     */
    protected $imageSet = 'mm';

    /**
     * Maximum rating (inclusive) [ g | pg | r | x ]
     * 
     * @var string
     */
    protected $maximumRating = 'g';

    /**
     * Optional, additional key/value attributes to include in the IMG tag
     * 
     * @var array 
     */
    protected $imageOptions = [];   // atts

    /**
     * @var string $email Email registered in Gravatar
     */
    public function __construct($email)
    {
        $sanitizeEmail = md5( strtolower( trim( $email ) ) );

        $this->email   = $sanitizeEmail;
    }

    /**
     * Return image url
     * 
     * @return string
     */
    public function buildURL()
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
    public function buildImage()
    {
        $url = $this->buildURL();

        $image = "<img src='{$url}'";

        foreach ($this->getImageOptions() as $key => $value) {
            $image .= ' ' . $key . '="'.$value.'"';
        }

        $image .= '/>';

        return $image;
    }

    /**
     * Size in pixels, defaults to 80px [ 1 - 2048 ]
     * 
     * @return void
     */
    public function setImageSize($size)
    {
        $this->imageSize = (int)$size;
    }

    public function getImageSize()
    {
        return $this->imageSize;
    }


    /**
     * Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * 
     * @return void 
     */
    public function setImageSet($set)
    {
        $set = trim($set);
        $set = strip_tags($set);

        switch($set){
            case '404':
                $value = '404';
            break;
            case 'identicon':
                $value = 'identicon';
            break;
            case 'monsterid':
                $value = 'monsterid';
            break;
            case 'wavatar':
                $value = 'wavatar';
            break;
            default:
                $value = 'mm';
            break;
        }

        $this->imageSet = $value;
    }

    public function getImageSet()
    {
        return $this->imageSet;
    }

    /**
     * Maximum rating (inclusive) [ g | pg | r | x ]
     *
     * @return void
     */
    public function setMaxRating($maxRating)
    {
        $maxRating = trim($maxRating);
        $maxRating = strip_tags($maxRating);

        switch($maxRating){
            case 'pg' :
                $value = 'pg';
            break;
            case 'r' :
                $value = 'r';
            break;
            case 'x' :
                $value = 'x';
            break;
            default;
                $value = 'g';
            break;
        }

        $thi->maximumRating = $value;
    }

    public function getMaxRating()
    {
        return $this->maximumRating;
    }

    public function setImageOptions(array $options)
    {
        $this->imageOptions = $options;
    }

    public function getImageOptions()
    {
        return $this->imageOptions;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUrlGravatarBase()
    {
        return $this->urlGravatar;
    }
}