<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 20:27
 * To change this template use File | Settings | File Templates.
 */

/* @property Partition[] $partitionList
 * @property CategoryType $type
 */
class Category extends PersistableEntity
{
    protected $visible;
    protected $type;
    protected $name;
    protected $preview;
    protected $detail;
    protected $url;
    protected $sort;

    protected $partitionList;

    public function setPartitionList($partitionList)
    {
        $this->partitionList = $partitionList;
    }

    public function getPartitionList()
    {
        if ($this->partitionList)
            return $this->partitionList;

        $arrItems = $this->select("SELECT id FROM partition WHERE category=" . $this->id . " ORDER BY sort");

        $typeParams = $this->getType()->getParams();

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = PersistableEntity::initEntityWithId($typeParams['childType'], $item['id']);

        $this->partitionList = $items;

        return $this->partitionList;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    /* @return CategoryType */
    public function getType()
    {
        return $this->getValueFor("type");
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

    /* @return Produce[] */
    public function loadProduceList($beginIndex = 0, $loadingQuantity = 7, $orderByRate = false, $onlyPresence = true, $distinct = true, $filter = "1")
    {
        $order = ($orderByRate === true) ? "pt.sort ASC, p.rating DESC" : "pt.sort ASC, pt.id ASC, p.sort ASC";
        $amount = ($onlyPresence === true) ? "p.amount>=0" : "1";
        $difference = ($distinct === true) ? "DISTINCT" : "";

        $arrItems = $this->select("SELECT $difference p.id
				FROM catalog AS p
				INNER JOIN catalog_prod2part AS pp ON pp.produce = p.id
				INNER JOIN catalog_partition AS pt ON pp.partition = pt.id
				WHERE pt.category=" . $this->id . " AND $amount AND $filter ORDER BY $order, pt.sort ASC LIMIT $beginIndex, $loadingQuantity");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Produce::initEntityWithId("Produce", $item['program']);

        return $items;
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO category (id, type, visible, name, preview, detail,
        url, sort) VALUES ("
            . $this->id . ", '"
            . $this->type->getCode() . "', '"
            . (($this->visible) ? 1 : 0) . "', '"
            . $this->name . "', '"
            . $this->getSQLValueFor("preview") . "', '"
            . $this->getSQLValueFor("detail") . "', '"
            . $this->getSQLValueFor("url") . "', '"
            . $this->getSQLValueFor("sort") . "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['type']))
            $this->type = CategoryType::getItemBy($arItem['type'], "CategoryType");

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
        $this->execute("UPDATE category SET"
            . " type='" . $this->type->getCode()
            . "', visible='" . (($this->visible) ? 1 : 0)
            . "', name='" . $this->name
            . "', preview='" . $this->getSQLValueFor("preview")
            . "', detail='" . $this->getSQLValueFor("detail")
            . "', url='" . $this->getSQLValueFor("url")
            . "', sort='" . $this->getSQLValueFor("sort")
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM category WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getPartitionList(), "Category refered by partitions: ");

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
        return "category";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("visible");
        $response .= $this->isEmptyValueFor("type");
        $response .= $this->isEmptyValueFor("name");
        $response .= $this->isEmptyValueFor("url");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setPartitionList(null);
        $this->getPartitionList();
    }

    /* @var Subcategory $subcatagory
     * @return Partition[]
     */
    public function getPartitionListBy($subcatagory)
    {
        $partitionList = Array();

        foreach ($this->getPartitionList() as $partition) {
            if ($subcatagory->equals($partition->getSubcategory()))
                $partitionList[] = $partition;
        }

        return $partitionList;
    }
}

;
