<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 18.08.14
 * Time: 8:21
 */
class YandexCategoryLeafView extends YandexCategoryView
{
    protected function echoBodyTemplate()
    {
        include "yandexCategoryLeafView.phtml";
    }
}