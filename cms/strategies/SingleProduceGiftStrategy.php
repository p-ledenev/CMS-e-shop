<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 7:38
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce */
class SingleProduceGiftStrategy extends GiftStrategy
{
    protected $produce;
    protected $amount;

    public function __construct($name, $produce, $amount = 0)
    {
        parent::__construct("single_produce_gift", $name);

        $this->produce = $produce;
        $this->amount = $amount;
    }

    protected function loadGiftListFor($deal)
    {
        if ($deal->getAmountWithDiscont() > $this->amount)
            return $this->loadFullGiftList();

        return Array();
    }

    public function loadFullGiftList()
    {
        return $this->createDealProduceListFor(Array($this->produce), 1);
    }
}