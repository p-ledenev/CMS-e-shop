<?php

/**
 * Created by PhpStorm.
 * User: dk
 * Date: 08.01.14
 * Time: 12:13
 */

/* @property Image $image */
class ImageLoaderView extends View
{
    protected $image;
    protected $url;

    public function __construct($image, $url)
    {
        $this->image = $image;
        $this->url = $url;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "imageLoaderView.phtml";
    }
}