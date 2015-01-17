<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer
 * @property Cart $cart
 */
class OrderIndexView extends View
{
    protected $customer;
    protected $cart;

    public function __construct($customer, $cart)
    {
        $this->customer = $customer;
        $this->cart = $cart;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "orderIndexView.phtml";
    }
}