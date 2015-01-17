<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 8:48
 * To change this template use File | Settings | File Templates.
 */

/* @property GeneralRequest $request*/
abstract class Controller
{
    protected $request;

    public function setCart($cart)
    {
        $this->request->setCart($cart);
    }

    public function getCart()
    {
        return $this->request->getCart();
    }

    public function setSubscriber($subscriber)
    {
        $this->request->setSubscriber($subscriber);
    }

    public function getSubscriber()
    {
        return $this->request->getSubscriber();
    }

    public function setCustomer($customer)
    {
        $this->request->setCustomer($customer);
    }

    public function getCustomer()
    {
        return $this->request->getCustomer();
    }

    public function __construct(&$request)
    {
        $this->request = $request;
    }

    /* @return View */
    public function process()
    {
        $manager = new CookieManager();
        $manager->validateCustomerByCookie($this->getCustomer());

        return $this->processOnController();
    }

    /* @return View */
    abstract protected function processOnController();
}