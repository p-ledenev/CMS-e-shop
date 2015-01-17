<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 7:47
 * To change this template use File | Settings | File Templates.
 */

/* @property PermissionManager $controller */
class ControlMainView extends ControlMainViewProlog
{
    private $strError;
    private $strInfo;
    private $controller;

    /* @param PermissionManager $controller */
    public function __construct($controller, $strError = null, $strInfo = null)
    {
        parent::__construct($controller->getCustomer());

        $this->controller = $controller;
        $this->strError = $strError;
        $this->strInfo = $strInfo;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
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

    protected function echoHeaderTemplate()
    {
        parent::echoHeaderTemplate();
        include "controlMainViewHeader.phtml";
    }

    protected function  echoFooterTemplate()
    {
        include "controlMainViewFooter.phtml";
        parent::echoFooterTemplate();
    }
}