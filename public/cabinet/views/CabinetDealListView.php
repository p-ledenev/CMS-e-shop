<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 05.09.13
 * Time: 9:44
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer
 * @property Cart $cart
 */
class CabinetDealListView extends CompositeView
{
    protected $customer;
    protected $cart;

    /* @param Customer $customer */
    public function __construct($cart, $customer)
    {
        $this->cart = $cart;
        $this->customer = $customer;
        $this->customer->reLoadWithReferences();

        foreach ($this->customer->getDealList() as $deal)
            $this->viewList[] = new CabinetDealView($deal);
    }

    protected function echoHeaderTemplate()
    {
        include "cabinetDealListViewHeader.phtml";
    }

    protected function  echoFooterTemplate()
    {
        include "cabinetDealListViewFooter.phtml";
    }
}