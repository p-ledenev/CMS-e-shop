<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 21.08.13
 * Time: 9:11
 * To change this template use File | Settings | File Templates.
 */

/* @property Address $address */
class CustomerInsertAddressView extends View
{
    protected $address;
    protected $url;
    protected $strError;
    protected $strInfo;

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
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

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function __construct($address, $url, $strError, $strInfo = null)
    {
        $this->address = $address;
        $this->url = $url;
        $this->strError = $strError;
        $this->strInfo = $strInfo;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "customerInsertAddressView.phtml";
    }
}