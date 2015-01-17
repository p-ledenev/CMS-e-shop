<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 7:47
 * To change this template use File | Settings | File Templates.
 */

/* @property GeneralRequest $request
 * @property Category $selectedCategory
 */
class MainView extends MainViewProlog
{
    private $strError;
    private $strInfo;

    private $request;

    private $selectedCategory;
    private $subscribeResultId;

    public function __construct($request, $selectedCategory = null, $strError = null, $strInfo = null)
    {
        parent::__construct();

        $this->strError = $strError;
        $this->strInfo = $strInfo;

        $this->request = $request;
        $this->selectedCategory = $selectedCategory;
        $this->subscribeResultId = "subscribe_result_id";
    }

    public function setSubscribeResultId($subscribeResultId)
    {
        $this->subscribeResultId = $subscribeResultId;
    }

    public function getSubscribeResultId()
    {
        return $this->subscribeResultId;
    }

    public function setCart($cart)
    {
        $this->request->setCart($cart);
    }

    public function getCart()
    {
        return $this->request->getCart();
    }

    public function setStrInfo($strInfo)
    {
        $this->strInfo = $strInfo;
    }

    public function getStrInfo()
    {
        return $this->strInfo;
    }

    public function setStrError($strError)
    {
        $this->strError = $strError;
    }

    public function getStrError()
    {
        return $this->strError;
    }

    public function setSelectedCategory($selectedCategory)
    {
        $this->selectedCategory = $selectedCategory;
    }

    public function getSelectedCategory()
    {
        return $this->selectedCategory;
    }

    public function setCustomer($customer)
    {
        $this->request->setCustomer($customer);
    }

    public function getCustomer()
    {
        return $this->request->getCustomer();
    }

    public function setSubscriber($subscriber)
    {
        $this->request->setSubscriber($subscriber);
    }

    public function getSubscriber()
    {
        return $this->request->getSubscriber();
    }

    protected function echoHeaderTemplate()
    {
        $subscribeResultView = new AJAXResultView($this->subscribeResultId);
        parent::echoHeaderTemplate();
        $subscribeResultView->view();
        include "mainViewHeader.phtml";
    }

    protected function echoFooterTemplate()
    {
        include "mainViewFooter.phtml";
        parent::echoFooterTemplate();
    }
}