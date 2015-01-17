<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 18:00
 * To change this template use File | Settings | File Templates.
 */

/* @property DealProduce $produce */
class ShowCartProduceView extends View
{
    protected $ind;
    protected $color;
    protected $produce;

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setInd($ind)
    {
        $this->ind = $ind;
    }

    public function getInd()
    {
        return $this->ind;
    }

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    public function __construct($produce, $ind, $color)
    {
        $this->produce = $produce;
        $this->color = $color;
        $this->ind = $ind;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "showCartProduceView.phtml";
    }
}