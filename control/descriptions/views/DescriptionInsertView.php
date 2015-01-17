<?php

/**
 * Created by PhpStorm.
 * User: dk
 * Date: 08.01.14
 * Time: 10:56
 */

/* @property Description $description */
abstract class DescriptionInsertView extends View
{
    protected $description;
    protected $url;

    public function __construct($description, $url)
    {
        $this->description = $description;
        $this->url = $url;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
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
}

;