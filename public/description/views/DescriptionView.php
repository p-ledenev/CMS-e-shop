<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 10.01.14
 * Time: 14:37
 */

/* @property Description $description */
abstract class DescriptionView extends View
{
    protected $description;

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function __construct($description)
    {
        $this->description = $description;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }
}