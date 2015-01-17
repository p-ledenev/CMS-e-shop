<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 08.08.13
 * Time: 17:37
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce
 */
abstract class Description extends PersistableEntity
{
    protected $title;
    protected $preview;
    protected $detail;
    protected $sort;
    protected $produce;

    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    public function getPreview()
    {
        return $this->getValueFor("preview");
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    public function getDetail()
    {
        return $this->getValueFor("detail");
    }

    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    public function getSort()
    {
        return $this->getValueFor("sort");
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->getValueFor("title");
    }

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    /* @return Produce */
    public function getProduce()
    {
        return $this->getValueFor("produce");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['produce']))
            $this->produce = Produce::initEntityWithId("Produce", $arItem['produce']);

        $this->setPostedValueFor("preview", $arItem['preview']);
        $this->setPostedValueFor("title", $arItem['title']);
        $this->setPostedValueFor("detail", $arItem['detail']);
        $this->setPostedValueFor("sort", $arItem['sort']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO catalog_description (id, title, preview, detail, produce, sort, type) VALUES ("
            . $this->id . ", '"
            . $this->getSQLValueFor("title") . "', '"
            . $this->getSQLValueFor("preview") . "', '"
            . $this->getSQLValueFor("detail") . "', '"
            . $this->produce->getId() . "', '"
            . $this->getSQLValueFor("sort") . "', '"
            . $this->getType() . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE catalog_description SET"
            . " title='" . $this->getSQLValueFor("title")
            . "', preview='" . $this->getSQLValueFor("preview")
            . "', detail='" . $this->getSQLValueFor("detail")
            . "', produce='" . $this->produce->getId()
            . "', sort='" . $this->getSQLValueFor("sort")
            . "', type='" . $this->getType()
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM catalog_description WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        return "";
    }

    public function toShortString()
    {
        return $this->getTitle();
    }

    public function toDetailString()
    {
        return $this->getTitle();
    }

    public function getPersistTableName()
    {
        return "catalog_description";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("sort");

        $response .= (!$this->produce || $this->produce->getId() <= 0) ? "empty produce<BR>" : "";

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
    }

    protected abstract function getType();
}

;