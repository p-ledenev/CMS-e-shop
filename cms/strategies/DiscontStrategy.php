<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 11.08.13
 * Time: 20:04
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
abstract class DiscontStrategy
{
    protected $customer;
    protected $customerDiscontPercent;

    public function __construct($customer = null, $customerDiscontPercent = null)
    {
        $this->customer = $customer;
        $this->customerDiscontPercent = $customerDiscontPercent;
    }

    /* @param Deal $deal */
    public function applayTo($deal)
    {
        $this->applayToDeal($deal);

        foreach ($deal->getProduceList() as $item)
            $this->applayToProduce($item);
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
        $this->customerDiscontPercent = null;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomerDiscontPercent($customerDiscontPercent)
    {
        $this->customerDiscontPercent = $customerDiscontPercent;
    }

    public function getCustomerDiscontPercent()
    {
        if (is_null($this->customerDiscontPercent))
            $this->customerDiscontPercent = $this->calculateDiscontForCustomer();

        return $this->customerDiscontPercent;
    }

    public abstract function getNextDiscontLevel();

    public abstract function getRestToNextDiscontLevel();

    /* @param Deal $deal */
    public abstract function isAchieveNextDiscontLevelBy($deal);

    protected abstract function calculateDiscontForCustomer();

    /* @param DealProduce $produce */
    abstract public function applayToProduce($produce);

    /* @param Deal $deal */
    protected abstract function applayToDeal($deal);

    public abstract function readParamsFrom($cdata);
}

;