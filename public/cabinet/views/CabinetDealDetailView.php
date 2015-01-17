<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 05.09.13
 * Time: 7:08
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class CabinetDealDetailView extends View
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
        include "cabinetDealDetailView.phtml";
    }
}