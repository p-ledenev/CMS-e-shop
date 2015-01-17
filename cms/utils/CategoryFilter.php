<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 7:20
 * To change this template use File | Settings | File Templates.
 */

/* @property CategoryType $type */
class CategoryFilter extends Filter
{
    private $type;
    private $onlyVisible;

    public function __construct($url, $type, $onlyVisible = true)
    {
        parent::__construct($url);

        $this->type = $type;
        $this->onlyVisible = $onlyVisible;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setFilter($cdata)
    {
        $this->type = CategoryType::getItemBy($cdata['type'], "CategoryType");
    }

    protected function buildQuery()
    {
        $response = " FROM category AS items WHERE 1";
        $response .= ($this->type->equals(CategoryType::$all)) ? "" : " AND type=" . $this->type->getCode();
        $response .= ($this->onlyVisible) ? " AND visible=1" : "";

        return $response . " ORDER BY items.sort ASC";
    }
}