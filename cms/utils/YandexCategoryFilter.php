<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 15.08.14
 * Time: 8:56
 */
class YandexCategoryFilter extends EntitySimpleFilter
{
    protected $hasParent;
    protected $hasNoParent;

    public function __construct($url, $hasParent = true, $hasNoParent = false, $name = null)
    {
        parent::__construct($url, $name);

        $this->hasParent = $hasParent;
        $this->hasNoParent = $hasNoParent;
    }

    protected function buildQuery()
    {
        $response = ($this->name) ? " AND items.name LIKE '%" . $this->name . "%'" : "";
        $response .= ($this->hasParent) ? " AND items.parent is not null AND items.parent<>0" : "";
        $response .= ($this->hasNoParent) ? " AND items.parent is null OR items.parent=0" : "";

        $response = " FROM " . $this->getPersistTableName() . " AS items WHERE 1" . $response . " ORDER BY items.name ASC";

        return $response;
    }

    protected function getEntityClassName()
    {
        return "YandexCategory";
    }
}