<?php

/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 11.08.13
 * Time: 20:36
 * To change this template use File | Settings | File Templates.
 */
class SimpleDiscontStrategy extends DiscontStrategy
{
    private static $carnivalPartitionIdList = Array();
    private static $carnivalCategoryIdList = Array();

    private static $notAllowCustomerDiscontPartitionIdList = Array(20105);
    private static $notAllowAccomulatePartitionIdList = Array();

    private $carnivalDiscontPercent;

    public function __construct($customer = null, $customerDiscontPercent = null)
    {
        parent::__construct($customer, $customerDiscontPercent);

        $this->carnivalDiscontPercent = 0;
    }

    /* @param DealProduce $produce */
    public function applayToProduce($produce)
    {
        $partitionList = $produce->getProduce()->getPartitionList();
        $categoryList = $produce->getProduce()->getCategoryList();

        $customerDiscontPercent = $this->getCustomerDiscontPercentFor($produce);
        $produce->setDiscontPercent($customerDiscontPercent);

        if ($this->inDiscontList("ProducePartition", SimpleDiscontStrategy::$notAllowAccomulatePartitionIdList, $partitionList))
            $produce->setInAccomulate(false);

        if ($this->inDiscontList("Category", SimpleDiscontStrategy::$carnivalCategoryIdList, $categoryList))
            $produce->setDiscontPercent($this->carnivalDiscontPercent + $customerDiscontPercent);

        if ($this->inDiscontList("ProducePartition", SimpleDiscontStrategy::$carnivalPartitionIdList, $partitionList))
            $produce->setDiscontPercent($this->carnivalDiscontPercent + $customerDiscontPercent);
    }

    protected function inDiscontList($className, $sourceList, $searchList)
    {
        foreach ($sourceList as $id) {

            $item = PersistableEntity::initEntityWithId($className, $id);
            if ($item->getContainsInIndex($searchList) !== false)
                return true;
        }

        return false;
    }

    /* @param DealProduce $produce */
    protected function getCustomerDiscontPercentFor($produce)
    {
        $partitionList = $produce->getProduce()->getPartitionList();

        if (!$this->inDiscontList("ProducePartition", SimpleDiscontStrategy::$notAllowCustomerDiscontPartitionIdList, $partitionList))
            return $this->getCustomerDiscontPercent();

        return 0;
    }

    protected function calculateDiscontForCustomer()
    {
        if (!$this->customer)
            return 0;

        if ($this->customer->getDiscontPercent() > 0)
            return $this->customer->getDiscontPercent();

        $purchase = $this->customer->calculateDealListPurchaseInAccomulate();

        if ($purchase < 5000)
            return 0;

        if ($purchase < 10000)
            return 5;

        if ($purchase >= 10000)
            return 10;
    }

    /* @param Deal $deal */
    protected function applayToDeal($deal)
    {
        $deal->setDiscontPercent($this->getCustomerDiscontPercent());
    }

    public function getNextDiscontLevel()
    {
        if (!$this->customer)
            return 0;

        if ($this->customer->getDiscontPercent() > 0)
            return $this->customer->getDiscontPercent();

        $discontPersent = $this->calculateDiscontForCustomer();

        if ($discontPersent == 0)
            return 5;

        if ($discontPersent == 5)
            return 10;

        return 0;
    }

    public function getRestToNextDiscontLevel()
    {
        if (!$this->customer)
            return 0;

        if ($this->customer->getDiscontPercent() > 0)
            return 0;

        $purchase = $this->customer->calculateDealListPurchaseInAccomulate();

        if ($purchase < 5000)
            return (5000 - $purchase);

        if ($purchase < 10000)
            return (10000 - $purchase);
    }

    /* @param Deal $deal */
    public function isAchieveNextDiscontLevelBy($deal)
    {
        $purchase = $deal->getAmountInAccomulate();

        if ($purchase < $this->getRestToNextDiscontLevel() || $this->getRestToNextDiscontLevel() == 0)
            return false;

        return true;
    }

    public function readParamsFrom($cdata)
    {
        if (!isset($cdata['carnivalDiscontPercent']))
            throw new Exception ("Excpected parameter 'carnivalDiscontPercent'");

        $this->carnivalDiscontPercent = $cdata['carnivalDiscontPercent'];
    }
}

;