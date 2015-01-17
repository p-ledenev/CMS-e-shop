<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 05.09.13
 * Time: 7:14
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer
 * @property Cart $cart
 */
class CabinetCustomerInfoView extends View
{
    protected $customer;
    protected $cart;

    public function __construct(&$cart, $customer)
    {
        $this->customer = $customer;
        $this->cart = $cart;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "cabinetCustomerInfoView.phtml";
    }
}