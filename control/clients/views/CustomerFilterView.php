<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 19.08.13
 * Time: 23:14
 * To change this template use File | Settings | File Templates.
 */

/* @property ClientFilter $filter */
class CustomerFilterView extends View
{
    protected $filter;

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
        include "customerFilterView.phtml";
    }
}