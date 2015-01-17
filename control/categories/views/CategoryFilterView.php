<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 22.08.13
 * Time: 17:27
 * To change this template use File | Settings | File Templates.
 */

/* @property CategoryFilter $filter */
class CategoryFilterView extends View
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
        include "categoryFilterView.phtml";
    }
}