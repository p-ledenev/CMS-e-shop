<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 20:56
 * To change this template use File | Settings | File Templates.
 */

/* @property YandexProduce[] $produceList
 * @property YandexCategory $parent
 * @property YandexCategory[] $childList
 */
class YandexCategory extends PersistableEntity
{
    protected $parent;
    protected $name;

    protected $produceList;
    protected $childList;

    public function setChildList($childList)
    {
        $this->childList = $childList;
    }

    public function getChildList()
    {
        if ($this->childList)
            return $this->childList;

        $arrItems = $this->select("SELECT id FROM yandex_category WHERE parent=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = YandexCategory::initEntityWithId("YandexCategory", $item['id']);

        $this->childList = $items;

        return $this->childList;
    }

    public function setProduceList($produceList)
    {
        $this->produceList = $produceList;
    }

    public function getProduceList()
    {
        if ($this->produceList)
            return $this->produceList;

        $arrItems = $this->select("SELECT id FROM yandex_catalog WHERE yandex_category=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = YandexProduce::initEntityWithId("YandexProduce", $item['id']);

        $this->produceList = $items;

        return $this->produceList;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->getValueFor("name");
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /* @return YandexCategory */
    public function getParent()
    {
        return $this->getValueFor("parent");
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO yandex_category (id, parrent, name) VALUES ("
            . $this->id . ", '"
            . $this->parent->getId() . "', '"
            . $this->name . "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->setPostedValueFor("name", $arItem['name']);
        $this->parent = YandexCategory::initEntityWithId("YandexCategory", $arItem['parent']);
    }

    public function updateEntity()
    {
        $this->execute("UPDATE yandex_category SET"
            . "', name='" . $this->name
            . "', parent='" . $this->parent->getId()
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM yandex_category WHERE id = " . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getProduceList(), "Yandex category refered by produces: ");

        return $response;
    }

    public function toShortString()
    {
        return $this->getName();
    }

    public function toDetailString()
    {
        return $this->getName();
    }

    public function getPersistTableName()
    {
        return "yandex_category";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("name");
        $response .= (!$this->parent) ? "parent category is empty<BR>" : "";

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setProduceList(null);
        $this->getProduceList();
    }

    public function hasChild()
    {
        return count($this->getChildList()) > 0;
    }
}

;
