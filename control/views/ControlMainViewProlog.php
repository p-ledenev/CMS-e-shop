<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 21.08.13
 * Time: 20:25
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class ControlMainViewProlog extends CompositeView
{
    protected $customer;

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    protected function echoHeaderTemplate()
    {
        include "controlMainViewPrologHeader.phtml";
    }

    protected function  echoFooterTemplate()
    {
        echo "
        </BODY>
        </HTML>
        ";
    }
}