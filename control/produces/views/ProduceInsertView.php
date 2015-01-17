<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 9:38
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce */
class ProduceInsertView extends View
{
    private $produce;

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
        include "produceInsertView.phtml";
    }
}