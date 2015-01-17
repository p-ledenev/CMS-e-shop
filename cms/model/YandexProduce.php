<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 20:56
 * To change this template use File | Settings | File Templates.
 */

/* @property YandexCategory $category
 * @property Produce $produce
 */
class YandexProduce extends PersistableEntity
{
    protected $produce;
    protected $category;
    protected $description;
    protected $rate;

    public function setCategory($category)
    {
        $this->category = $category;
    }

    /* @return YandexCategory */
    public function getCategory()
    {
        return $this->getValueFor("category");
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->getValueFor("description");
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

    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    public function getRate()
    {
        return $this->getValueFor("rate");
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO yandex_catalog (id, produce, yandex_category, description, rate) VALUES ("
            . $this->getId() . ", '"
            . $this->produce->getId() . "', '"
            . $this->category->getId() . "', '"
            . $this->getSQLValueFor("description") . "', '"
            . $this->getSQLValueFor("rate") . "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->setPostedValueFor("description", $arItem['description']);
        $this->setPostedValueFor("rate", $arItem['rate']);

        if ($arItem['produce'])
            $this->produce = Produce::initEntityWithId("Produce", $arItem['produce']);

        if ($arItem['yandex_category'])
            $this->category = YandexCategory::initEntityWithId("YandexCategory", $arItem['yandex_category']);
    }

    public function updateEntity()
    {
        $this->execute("UPDATE yandex_catalog SET"
            . " produce='" . $this->produce->getId()
            . "', yandex_category='" . $this->category->getId()
            . "', description='" . $this->getSQLValueFor("description")
            . "', rate='" . $this->getSQLValueFor("rate")
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM yandex_catalog WHERE id = " . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        return "";
    }

    public function toShortString()
    {
        return $this->getDescription();
    }

    public function toDetailString()
    {
        return $this->getDescription();
    }

    public function getPersistTableName()
    {
        return "yandex_catalog";
    }

    protected function getPersistImposibilityReason()
    {
        $response = (!$this->produce || $this->produce->getId() < 0) ? "produce is empty<BR>" : "";
        $response .= (!$this->category || $this->category->getId() < 0) ? "yandex category is empty<BR>" : "";

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
    }

    public function hasDescription()
    {
        return ($this->getDescription() != null && strlen(trim($this->getDescription())) > 0);
    }
}

;
