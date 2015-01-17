<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 15.08.14
 * Time: 8:26
 */

/* @property YandexProduce $produce */
class YandexProduceInsertView extends View
{
    protected $produce;

    public function __construct($produce)
    {
        $this->produce = $produce;
    }

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "yandexProduceInsertView.phtml";
    }
}