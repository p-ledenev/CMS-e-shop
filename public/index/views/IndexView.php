<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.08.13
 * Time: 8:35
 * To change this template use File | Settings | File Templates.
 */
class IndexView extends View
{
    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "indexView.phtml";
    }
}