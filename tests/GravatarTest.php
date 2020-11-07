<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use DiegoBrocanelli\Gravatar\Image;
use DiegoBrocanelli\Gravatar\Gravatar;

class GravatarTest extends TestCase
{
    const VALID_EMAIL = 'diegod2@msn.com';

    public function testInvalidEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        new Gravatar('babab_abhhhh.foo.bar');
    }

    public function testImageSize(): void
    {
        $gravatar = new Gravatar(self::VALID_EMAIL);
        $gravatar->setImageSize(1);
        
        $this->assertEquals( $gravatar->getImageSize(), 1);
        
        $gravatar->setImageSize(2048);
        $this->assertEquals( $gravatar->getImageSize(), 2048);
    }

    public function testInvalidImageSizeLessOne(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        (new Gravatar(self::VALID_EMAIL))->setImageSize(0);
    }

    public function testInvalidImageSizeGreaterThanLimit(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        (new Gravatar(self::VALID_EMAIL))->setImageSize(2049);
    }

    public function testImageSet(): void
    {
        $gravatar = new Gravatar(self::VALID_EMAIL);

        foreach($gravatar::IMAGE_SET_LIST as $size){
            $gravatar->setImageSet($size);
            $this->assertEquals( $gravatar->getImageSet(), $size);
        }
    }

    public function testeInvalidImageSite(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        (new Gravatar(self::VALID_EMAIL))->setImageSet('foo');
    }

    public function testMaximumRating(): void
    {
        $gravatar = new Gravatar(self::VALID_EMAIL);

        foreach($gravatar::MAXIMUM_RATING_LIST as $rating){
            $gravatar->setMaxRating($rating);
            $this->assertEquals( $gravatar->getMaxRating(), $rating);
        }
    }

    public function testInvalidMaximumRating(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        (new Gravatar(self::VALID_EMAIL))->setMaxRating('foo');
    }

    public function testImageAttributes(): void
    {
        $gravatar = new Gravatar(self::VALID_EMAIL);

        foreach($gravatar::ATTRIBUTES_LIST as $attribute){
            $gravatar->setImageAttribute($attribute, 'value');
            $this->assertEquals( $gravatar->getAttribute($attribute), 'value');
        }
    }

    public function testInvalidImageAttributes(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        (new Gravatar(self::VALID_EMAIL))->setImageAttribute('foo', 'baar');
    }

    public function testBuildURL()
    {
        $gravatar = new Gravatar(self::VALID_EMAIL);

        $urlComparation  = $gravatar->getUrlGravatarBase();
        $urlComparation .= md5( strtolower( trim( self::VALID_EMAIL ) ) );
        $urlComparation .= '?s=80&d=mm&r=g';

        $this->assertEquals($gravatar->buildURL(), $urlComparation);
    }
}