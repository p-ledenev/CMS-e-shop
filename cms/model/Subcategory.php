<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 20:56
 * To change this template use File | Settings | File Templates.
 */

/* @return Partition[] $partitionList */
class Subcategory extends PersistableEntity
{
    protected $visible;
    protected $name;
    protected $preview;
    protected $detail;
    protected $url;
    protected $sort;

    private $partitionList;

    public function setPartitionList($partitionList)
    {
        $this->partitionList = $partitionList;
    }

    public function getPartitionList()
    {
        if ($this->partitionList)
            return $this->partitionList;

        $arrItems = $this->select("SELECT id, category FROM partition WHERE subcategory=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item) {

            /* @var Category $category */
            $category = Category::initEntityWithId("Category", $item['category']);
            $typeParams = $category->getType()->getParams();

            $items[] = PersistableEntity::initEntityWithId($typeParams['childType'], $item['id']);
        }

        $this->partitionList = $items;

        return $this->partitionList;
    }


    /* @return Partition[]
     * @var Category $category
     */
    public function getPartitionListBy($category)
    {
        $arrItems = $this->base->select("SELECT id FROM partition WHERE
        subcategory=" . $this->id . " AND category=" . $category->getId());

        $typeParams = $category->getType()->getParams();

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = PersistableEntity::initEntityWithId($typeParams['childType'], $item['id']);

        return $items;
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
        $this->execute("INSERT INTO subcategory (id, visible, name, preview, detail, url, sort) VALUES ("
            . $this->id . ", '"
            . (($this->visible) ? "1" : "0") . "', '"
            . $this->name . "', '"
            . $this->getSQLValueFor("preview") . "', '"
            . $this->getSQLValueFor("detail") . "', '"
            . $this->getSQLValueFor("url") . "', '"
            . $this->getSQLValueFor("sort") . "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['visible']))
            $this->visible = ($arItem['visible'] > 0) ? true : false;

        $this->setPostedValueFor("name", $arItem['name']);
        $this->setPostedValueFor("preview", $arItem['preview']);
        $this->setPostedValueFor("detail", $arItem['detail']);
        $this->setPostedValueFor("url", $arItem['url']);
        $this->setPostedValueFor("sort", $arItem['sort']);
    }

    public function updateEntity()
    {
        $this->execute("UPDATE subcategory SET"
            . " visible='" . (($this->visible) ? "1" : "0")
            . "', name='" . $this->name
            . "', preview='" . $this->getSQLValueFor("preview")
            . "', detail='" . $this->getSQLValueFor("detail")
            . "', url='" . $this->getSQLValueFor("url")
            . "', sort='" . $this->getSQLValueFor("sort")
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM subcategory WHERE id = " . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getPartitionList(), "Subcategory refered by partitions: ");

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
        return "subcategory";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("visible");
        $response .= $this->isEmptyValueFor("name");
        $response .= $this->isEmptyValueFor("url");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setPartitionList(null);
        $this->getPartitionList();
    }
}

;
