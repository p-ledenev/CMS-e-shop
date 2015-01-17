<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:13
 * To change this template use File | Settings | File Templates.
 */

class AnyDealGiftStrategy extends GiftStrategy
{

    public function __construct($name = "Подарок к заказу")
    {
        parent::__construct("any_stock_gift", $name);
    }

    protected function loadGiftListFor($deal)
    {
        return $this->loadFullGiftList();
    }

    public function loadFullGiftList()
    {
        /* @var ProducePartition $partition */
        $partition = ProducePartition::initEntityByUrl(Constants::$stockGiftPartitionUrl);

        return $this->createDealProduceListFor($partition->getItemList(), 1);
    }
}