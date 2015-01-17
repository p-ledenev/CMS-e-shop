<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 7:20
 * To change this template use File | Settings | File Templates.
 */
class SubcategoryFilter extends Filter
{
    private $onlyVisible;

    public function __construct($url, $onlyVisible = true)
    {
        parent::__construct($url);

        $this->onlyVisible = $onlyVisible;
    }

    public function setFilter($cdata)
    {
        $this->onlyVisible = ($cdata['only_visible']) ? true : false;
    }

    protected function buildQuery()
    {
        $response = " FROM subcategory AS items WHERE 1";
        $response .= ($this->onlyVisible) ? " AND visible=1" : "";

        return $response . " ORDER BY items.sort ASC";
    }
}