<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 7:44
 * To change this template use File | Settings | File Templates.
 */

/* @property Repository $base
 * @property Navigation $navigation
 */
abstract class Filter
{
    public static $base;

    private $navigation;
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;
    }

    public function getNavigation()
    {
        if ($this->navigation)
            return $this->navigation;

        $this->navigation = new Navigation($this->countItemList(), $this->url);

        return $this->navigation;
    }

    public abstract function setFilter($cdata);

    /* @return PersistableEntity */
    public function loadItemList($className)
    {
        $navigation = $this->getNavigation();

        $arItems = $this->select("SELECT items.id" . $this->buildQuery() . " LIMIT " .
            $navigation->getStartsFrom() . ", " . $navigation->getPerPage());

        $itemList = Array();
        foreach ($arItems as $item)
            $itemList[] = PersistableEntity::initEntityWithId($className, $item['id']);

        return $itemList;
    }

    public function countItemList()
    {
        $arCount = $this->select("SELECT count(items.id) AS totalCount" . $this->buildQuery());

        if (count($arCount) <= 0)
            return 0;

        if (count($arCount) > 1)
            return count($arCount);

        return $arCount[0]['totalCount'];
    }

    protected function select($data)
    {
        return Filter::$base->select($data);
    }

    protected function execute($query)
    {
        return Filter::$base->executeSecure($query);
    }

    protected abstract function buildQuery();

    public function getSQLValueFor($property)
    {
        if ($this->$property)
            return htmlentities($this->$property, ENT_QUOTES, "cp1251");

        return "";
    }
}