<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 07.04.14
 * Time: 8:39
 */

/* @property Produce $produce */
class SearchResultProduceView extends View
{
    protected $produce;
    protected $color;

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function __construct($produce)
    {
        $this->produce = $produce;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "searchResultProduceView.phtml";
    }
}