<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 8:49
 * To change this template use File | Settings | File Templates.
 */
class CabinetAuthView extends OrderAuthView
{
    protected function echoBodyTemplate()
    {
        include "cabinetAuthView.phtml";
    }
}