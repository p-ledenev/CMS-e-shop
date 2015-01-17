<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 28.08.13
 * Time: 17:54
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class PermissionManager
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

    public function getMenu()
    {
        ob_start();

        include $_SERVER['DOCUMENT_ROOT'] . "/control/views/controlMainViewMenu.phtml";
        $response = ob_get_contents();

        ob_end_clean();

        return $response;
    }

    public function allowContent($url)
    {
        if ((!$this->customer || $this->customer->getId() <= 0) && strstr($url, "/control/auth.php") === false)
            echo header("Location: http://$_SERVER[HTTP_HOST]/control/auth.php");

        return true;
    }
}