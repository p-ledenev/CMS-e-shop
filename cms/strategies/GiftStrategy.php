<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:12
 * To change this template use File | Settings | File Templates.
 */

abstract class GiftStrategy
{
    protected $name;
    protected $id;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /* @param Deal $deal
     * @retrun DealProduce[]
     */
    public function loadGiftListForDeal($deal)
    {
        if (!$deal)
            return Array();

        return $this->loadGiftListFor($deal);
    }

    /* @param Deal $deal
     * @retrun DealProduce[]
     */
    abstract protected function loadGiftListFor($deal);

    /* @retrun DealProduce[] */
    public abstract function loadFullGiftList();

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    /* @param Produce[] $produceList
     * return DealProduce[]
     */
    protected function createDealProduceListFor($produceList, $amount)
    {
        $dealProduceList = Array();
        foreach ($produceList as $produce)
            $dealProduceList[] = new DealProduce($produce, null, $produce->getPrice(), $amount);

        return $dealProduceList;
    }
}

;