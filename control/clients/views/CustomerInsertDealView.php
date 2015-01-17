<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 22.08.13
 * Time: 8:34
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class CustomerInsertDealView extends CompositeView
{
    private $deal;

    /* @param Deal $deal */
    public function __construct($deal)
    {
        parent::__construct();

        $this->deal = $deal;
        foreach ($this->deal->getProduceList() as $key => $produce)
            $this->viewList[] = new CustomerInsertDealProduceView($produce, $key);
    }

    public function setDeal($deal)
    {
        $this->deal = $deal;
    }

    public function getDeal()
    {
        return $this->deal;
    }

    protected function echoHeaderTemplate()
    {
        include "customerInsertDealViewHeader.phtml";
    }

    protected function  echoFooterTemplate()
    {
        include "customerInsertDealViewFooter.phtml";
    }
}

;