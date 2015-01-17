<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 09.08.13
 * Time: 8:31
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce
 * @property Deal $deal
 */
class DealProduce extends PersistableEntity
{
    protected $produce;
    protected $amount;
    protected $price;
    protected $discontPercent;
    protected $inAccomulate;
    protected $deal;

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->getValueFor("amount");
    }

    public function increaseAmountBy($amount)
    {
        $this->amount += $amount;
    }

    public function setDeal($deal)
    {
        $this->deal = $deal;
    }

    /* @return Deal */
    public function getDeal()
    {
        return $this->getValueFor("deal");
    }

    public function setDiscontPercent($discontPercent)
    {
        $this->discontPercent = $discontPercent;
    }

    public function getDiscontPercent()
    {
        return $this->getValueFor("discontPercent");
    }

    public function setInAccomulate($inAccomulate)
    {
        $this->inAccomulate = $inAccomulate;
    }

    public function getInAccomulate()
    {
        return $this->getValueFor("inAccomulate");
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->getValueFor("price");
    }

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function setId($id)
    {
    }

    public function getId()
    {
    }

    public function setNewId()
    {
    }

    /* @return Produce */
    public function getProduce()
    {
        return $this->getValueFor("produce");
    }

    /* @var Deal $deal
     * @var Produce $produce
     */
    public function __construct($produce, $deal, $price = 0, $amount = 0)
    {
        parent::__construct();

        $this->produce = $produce;
        $this->deal = $deal;

        $this->price = $price;
        $this->amount = $amount;

        $this->discontPercent = 0;
        $this->inAccomulate = true;
    }

    public function initEntityById()
    {
        $arItem = $this->select("SELECT * FROM deal_produce WHERE produce=" . $this->produce->getId() . " AND deal=" . $this->deal->getId());

        $this->loaded = true;
        $this->fillEntityByArray($arItem[0]);
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['in_accomulate']))
            $this->inAccomulate = ($arItem['in_accomulate'] > 0) ? true : false;

        $this->setPostedValueFor("price", $arItem['price']);
        $this->setPostedValueFor("amount", $arItem['amount']);
        $this->setPostedValueFor("discontPercent", $arItem['discont_percent']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO deal_produce (deal, produce, price, amount, discont_percent, in_accomulate) VALUES ("
            . $this->deal->getId() . ", '"
            . $this->produce->getId() . "', '"
            . $this->price . "', '"
            . $this->amount . "', '"
            . $this->getSQLValueFor("discontPercent") . "', '"
            . (($this->inAccomulate) ? "1" : "0") . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE deal_produce SET"
            . " price='" . $this->price
            . "', amount='" . $this->amount
            . "', discont_percent='" . $this->getSQLValueFor("discontPercent")
            . "', in_accomulate='" . (($this->inAccomulate) ? "1" : "0")
            . "' WHERE produce=" . $this->produce->getId()
            . " AND deal=" . $this->deal->getId());
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM deal_produce WHERE produce=" . $this->produce->getId() . " AND deal=" . $this->deal->getId());
    }

    protected function getRemoveImossibilityReason()
    {
        return "";
    }

    /* @param DealProduce $entity
     * @return bool
     */
    public function equals($entity)
    {
        if ((is_null($this->deal) || $this->deal->getId() == $entity->getDeal()->getId()) &&
            $this->produce->getId() == $entity->getProduce()->getId()
        )
            return true;

        return false;
    }

    public function toShortString()
    {
        return "deal: " . $this->deal->getId() . "; " . $this->produce->getTitle();
    }

    public function toDetailString()
    {
        return "deal: " . $this->deal->getId() . "; produce: (" . $this->produce->getId() . ") " .
        $this->produce->getTitle() . "; amount: " . $this->amount
        . "; price: " . $this->price . "; discont: " . $this->getDiscontPercent() . "; inAccomulate: " . $this->inAccomulate;
    }

    public function getPersistTableName()
    {
        return "deal_produce";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("produce");
        $response .= $this->isEmptyValueFor("amount");
        $response .= $this->isEmptyValueFor("price");
        $response .= $this->isEmptyValueFor("deal");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
    }

    public function isPersisted()
    {
        $arItem = $this->select("SELECT deal, produce FROM " . $this->getPersistTableName() .
            " WHERE produce=" . $this->produce->getId() . " AND deal=" . $this->deal->getId());

        if (count($arItem) > 0)
            return true;

        return false;
    }
}

;