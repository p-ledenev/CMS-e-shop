<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 19:36
 * To change this template use File | Settings | File Templates.
 */

/* @property Category $category
 * @property Subcategory $subcategory
 * @property PersistableEntity[] $itemList
 */
abstract class Partition extends PersistableEntity
{
    protected $visible;
    protected $onMain;
    protected $category;
    protected $subcategory;
    protected $name;
    protected $preview;
    protected $detail;
    protected $url;
    protected $sort;

    protected $itemList;

    public function setItemList($itemList)
    {
        $this->itemList = $itemList;
    }

    abstract public function getItemList();

    public function setCategory($category)
    {
        $this->category = $category;
    }

    /* @return Category */
    public function getCategory()
    {
        return $this->getValueFor("category");
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    public function getDetail()
    {
        return $this->getValueFor("detail");
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->getValueFor("name");
    }

    public function setOnMain($onMain)
    {
        $this->onMain = $onMain;
    }

    public function getOnMain()
    {
        return $this->getValueFor("onMain");
    }

    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    public function getPreview()
    {
        return $this->getValueFor("preview");
    }

    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    public function getSort()
    {
        return $this->getValueFor("sort");
    }

    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /* @return Subcategory */
    public function getSubcategory()
    {
        return $this->getValueFor("subcategory");
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->getValueFor("url");
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    public function getVisible()
    {
        return $this->getValueFor("visible");
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO partition (id, visible, onmain, category,
        subcategory, name, preview, detail, url, sort) VALUES ("
            . $this->id . ", '"
            . (($this->visible) ? "1" : "0") . "', '"
            . (($this->onMain) ? "1" : "0") . "', '"
            . $this->category->getId() . "', '"
            . $this->subcategory->getId() . "', '"
            . $this->getSQLValueFor("name") . "', '"
            . $this->getSQLValueFor("preview") . "', '"
            . $this->getSQLValueFor("detail") . "', '"
            . $this->getSQLValueFor("url") . "', '"
            . $this->getSQLValueFor("sort") . "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['onmain']))
            $this->onMain = ($arItem['onmain'] > 0) ? true : false;

        if (isset($arItem['visible']))
            $this->visible = ($arItem['visible'] > 0) ? true : false;

        if (isset($arItem['category']))
            $this->category = Category::initEntityWithId("Category", $arItem['category']);

        if (isset($arItem['subcategory']))
            $this->subcategory = Subcategory::initEntityWithId("Subcategory", $arItem['subcategory']);

        $this->setPostedValueFor("id", $arItem['id']);
        $this->setPostedValueFor("name", $arItem['name']);
        $this->setPostedValueFor("preview", $arItem['preview']);
        $this->setPostedValueFor("detail", $arItem['detail']);
        $this->setPostedValueFor("url", $arItem['url']);
        $this->setPostedValueFor("sort", $arItem['sort']);
    }

    public function updateEntity()
    {
        $this->execute("UPDATE partition SET"
            . " id=" . $this->id
            . ", visible='" . (($this->visible) ? "1" : "0")
            . "', onmain='" . (($this->onMain) ? "1" : "0")
            . "', category='" . $this->category->getId()
            . "', subcategory='" . $this->subcategory->getId()
            . "', name='" . $this->getSQLValueFor("name")
            . "', preview='" . $this->getSQLValueFor("preview")
            . "', detail='" . $this->getSQLValueFor("detail")
            . "', url='" . $this->getSQLValueFor("url")
            . "', sort='" . $this->getSQLValueFor("sort")
            . "' WHERE id = " . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM partition WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getItemList(), "Partition refered by items: ");

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
        return "partition";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("category");
        $response .= $this->isEmptyValueFor("subcategory");
        $response .= $this->isEmptyValueFor("name");
        $response .= $this->isEmptyValueFor("url");
        $response .= $this->isEmptyValueFor("sort");

        $response .= ($this->category && $this->category->getId() < 0) ? "category is empty<BR>" : "";
        $response .= ($this->subcategory && $this->subcategory->getId() < 0) ? "subcategory is empty<BR>" : "";

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setItemList(null);
        $this->getItemList();
    }

    public static function initEntityByUrl($url)
    {
        /* @var CategoryType $categoryType */
        foreach (CategoryType::getAllItems("CategoryType") as $categoryType) {

            $categoryParams = $categoryType->getParams();

            if (!$categoryParams['childType'])
                return ProducePartition::initEntity("ProducePartition");

            /* @var Partition $partition */
            $partition = parent::initEntityByUrl($categoryParams['childType'], $url);
            if ($partition->isPersisted() && $categoryType->equals($partition->getCategory()->getType()))
                return $partition;
        }

        return ProducePartition::initEntity("ProducePartition");
    }
}

;