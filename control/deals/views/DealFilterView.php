<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 8:05
 * To change this template use File | Settings | File Templates.
 */

/* @property DealFilter $filter */
class DealFilterView extends View
{
    private $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "dealFilterView.phtml";
    }
}