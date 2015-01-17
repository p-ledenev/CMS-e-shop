<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 8:49
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class OrderAuthView extends View
{
    protected $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "orderAuthView.phtml";
    }
}