<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 04.09.13
 * Time: 7:23
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class CustomerNewEmailView extends View
{
    protected $customer;
    protected $password;

    public function __construct($customer, $password)
    {
        $this->customer = $customer;
        $this->password = $password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
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
        include "customerNewEmailView.phtml";
    }
}