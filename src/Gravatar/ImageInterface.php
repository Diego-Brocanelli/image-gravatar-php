<?php

namespace DiegoBrocanelli\Gravatar;

/**
 * @author Diego Brocanelli <diegod2@msn.com>
 */
interface ImageInterface
{
    public function buildURL();

    public function buildImage();

    public function setImageSize($size);

    public function getImageSize();
    
    public function setImageSet($set);

    public function getImageSet();

    public function setMaxRating($maxRating);

    public function getMaxRating();

    public function setImageOptions(array $options);

    public function getImageOptions();

    public function getEmail();

    public function getUrlGravatarBase();
}
