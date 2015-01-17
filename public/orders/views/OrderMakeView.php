<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 03.09.13
 * Time: 18:05
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class OrderMakeView extends View
{
    protected $deal;
    public function __construct($deal)
    {
        $this->deal = $deal;
    }

    public function setDeal($deal)
    {
        $this->deal = $deal;
    }

    public function getDeal()
    {
        return $this->deal;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "orderMakeView.phtml";
    }
}