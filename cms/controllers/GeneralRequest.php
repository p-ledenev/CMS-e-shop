<?php
/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 07.08.14
 * Time: 17:31
 */

/* @property Cart $cart
 * @property Customer $customer
 * @property Subscriber $subscriber
 */
class GeneralRequest
{
    protected $cart;
    protected $customer;
    protected $subscriber;

    public function __construct(&$cart, &$customer, &$subscriber)
    {
        $this->cart = $cart;
        $this->customer = $customer;
        $this->subscriber = $subscriber;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function getSubscriber()
    {
        return $this->subscriber;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
} 