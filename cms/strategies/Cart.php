<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 10.08.13
 * Time: 17:25
 * To change this template use File | Settings | File Templates.
 */

/* @property DealProduce[] $produceList
 * @property DiscontStrategy $discontStrategy
 * @property GiftStrategy[] $giftStrategyList
 */
class Cart
{
    private $produceList;
    private $discontStrategy;
    private $giftStrategyList;

    public function __construct()
    {
        $this->produceList = Array();
        $this->giftStrategyList = Array();
    }

    public function setProduceList($produceList)
    {
        $this->produceList = $produceList;
    }

    public function getProduceList()
    {
        return $this->produceList;
    }

    public function setDiscontStrategy($discontStrategy)
    {
        $this->discontStrategy = $discontStrategy;
    }

    public function getDiscontStrategy()
    {
        return $this->discontStrategy;
    }

    public function setGiftStrategy($giftStrategyList)
    {
        $this->giftStrategyList = $giftStrategyList;
    }

    public function getGiftStrategyList()
    {
        return $this->giftStrategyList;
    }

    /* @var DealProduce $item */
    public function addItem($item)
    {
        $ind = $item->getContainsInIndex($this->produceList);

        if ($ind === false)
            $this->produceList[] = $item;
        else
            $this->produceList[$ind]->increaseAmountBy($item->getAmount());
    }

    /* @param Produce $produce */
    public function addItemBy($produce, $amount, $deal = null)
    {
        $item = new DealProduce($produce, $deal);
        $item->setAmount($amount);
        $item->setPrice($produce->getPrice());

        $this->addItem($item);
    }

    /* @param DealProduce $item */
    public function removeItem($item)
    {
        $this->setProduceList($item->removeFrom($this->produceList));
    }

    public function countProduceList()
    {
        return count($this->produceList);
    }

    public function countProducePurchase()
    {
        $purchase = 0;
        foreach ($this->produceList as $produce)
            $purchase += $produce->getAmount() * $produce->getPrice();

        return $purchase;
    }

    public function countProduceAmount()
    {
        $quantity = 0;
        foreach ($this->produceList as $produce)
            $quantity += $produce->getAmount();

        return $quantity;
    }

    public function clear()
    {
        $this->produceList = Array();
    }

    public function isEmpty()
    {
        return $this->countProduceList() <= 0;
    }
}

;