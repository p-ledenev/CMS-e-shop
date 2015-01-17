<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 8:49
 * To change this template use File | Settings | File Templates.
 */

class CabinetAuthController extends OrderAuthController
{
    public function __construct(&$request, $cdata) {
        parent::__construct($request, $cdata);
    }

    protected function getMainView()
    {
        return new CabinetAuthView($this->getCustomer());
    }

    protected function getUrl() {
        return "cabinet";
    }
}

;

