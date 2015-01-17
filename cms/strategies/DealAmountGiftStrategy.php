<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:13
 * To change this template use File | Settings | File Templates.
 */

class DealAmountGiftStrategy extends GiftStrategy
{
    protected $amount;

    public function __construct($amount, $name = "Подарок по текущей акции")
    {
        parent::__construct("amount_stock_gift", $name);

        $this->$amount = $amount;
    }

    protected function loadGiftListFor($deal)
    {
        if ($deal->getAmount() < $this->amount)
            return Array();

        /* @var ProducePartition $partition */
        $partition = ProducePartition::initEntityByUrl(Constants::$amountGiftPartitionUrl);

        return $this->createDealProduceListFor($partition->getProduceListForGiftAmount($deal->getAmountWithDiscont()), 1);
    }

    public function loadFullGiftList()
    {
        /* @var ProducePartition $partition */
        $partition = ProducePartition::initEntityByUrl(Constants::$stockGiftPartitionUrl);

        return $this->createDealProduceListFor($partition->getItemList(), 1);
    }
}