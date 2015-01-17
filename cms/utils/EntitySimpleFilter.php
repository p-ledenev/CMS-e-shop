<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 25.09.13
 * Time: 8:06
 * To change this template use File | Settings | File Templates.
 */

abstract class EntitySimpleFilter extends Filter
{
    protected $name;

    public function __construct($url, $name = null)
    {
        parent::__construct($url);

        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setFilter($cdata)
    {
        $this->name = $cdata['name'];
    }

    protected function buildQuery()
    {
        $response = ($this->name) ? " AND items.name LIKE '%" . $this->name . "%'" : "";

        $response = " FROM " . $this->getPersistTableName() . " AS items WHERE 1" . $response . " ORDER BY items.name ASC";

        return $response;
    }

    protected function getPersistTableName()
    {
        $entity = PersistableEntity::initEntity($this->getEntityClassName());

        return $entity->getPersistTableName();
    }

    protected abstract function getEntityClassName();
}