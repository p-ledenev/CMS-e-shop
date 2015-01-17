<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:13
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class LoyalCustomerGiftStrategy extends GiftStrategy
{
    protected $customer;

    public function __construct(&$customer, $name = "Подарок постоянного покупателя")
    {
        parent::__construct("loyal_customer_gift", $name);

        $this->customer = $customer;
    }

    protected function loadGiftListFor($deal)
    {
        if (!$this->customer)
            return Array();

        $amount = $this->customer->calculateDealListPurchaseWithDiscont();

        if ($amount < 15000)
            return Array();

        /* @var ProducePartition $partition */
        $partition = ProducePartition::initEntityByUrl(Constants::$customerGiftPartitionUrl);

        return $this->createDealProduceListFor($partition->getProduceListForGiftAmount($deal->getAmountWithDiscont()), 1);
    }

    public function loadFullGiftList()
    {
        /* @var ProducePartition $partition */
        $partition = ProducePartition::initEntityByUrl(Constants::$customerGiftPartitionUrl);

        return $this->createDealProduceListFor($partition->getItemList(), 1);
    }
}