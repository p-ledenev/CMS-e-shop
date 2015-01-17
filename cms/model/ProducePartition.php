<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 18:48
 * To change this template use File | Settings | File Templates.
 */
class ProducePartition extends Partition
{
    public function getItemList()
    {
        if ($this->produceList)
            return $this->produceList;

        $arrItems = $this->select("SELECT produce FROM catalog_prod2part WHERE partition=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = PersistableEntity::initEntityWithId("Produce", $item['produce']);

        $this->produceList = $items;

        return $this->produceList;
    }

    /* @param Produce $produce */
    public function excludeProduceFromList($produce)
    {
        $response = Array();
        $produceList = $this->getItemList();

        /* @var Produce $item */
        foreach ($produceList as $item)
            if (!$item->equals($produce))
                $response[] = $item;

        return $response;
    }

    public function getProduceListForGiftAmount($giftAmount)
    {
        $amountType = GiftAmount::getItemByAmount($giftAmount);
        $arrItems = $this->select("SELECT p.id FROM catalog AS p
                       INNER JOIN catalog_prod2part AS pp ON pp.produce=p.id
                       WHERE partition=" . $this->id . " AND p.gift_amount is not null
                       AND p.gift_amount <> 0 AND p.gift_amount=" . $amountType->getCode());

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Produce::initEntityWithId("Produce", $item['id']);

        return $items;
    }

    public function isAnyProduceAvailable()
    {
        /* @var Produce $produce */
        foreach ($this->getItemList() as $produce)
            if ($produce->isPresence() || $produce->isWaiting())
                return true;

        return false;
    }
}