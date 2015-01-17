<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 17.08.13
 * Time: 14:20
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class DealPostFormView extends View
{
    private $deal;

    public function __construct($deal)
    {
        $this->deal = $deal;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        if (!$this->deal->getAddress()->getInMoscow())
            include "dealPostFormView.phtml";
    }
}