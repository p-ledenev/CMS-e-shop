<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 11.12.13
 * Time: 9:43
 */

function includeClass($path)
{
    if (file_exists($path)) {
        include($path);
        return true;
    }

    return false;
}

function classLoader($class)
{
    $serverRoot = $_SERVER['DOCUMENT_ROOT'];

    $arrPath = Array(
        "/cms/model/", "/cms/utils/", "/cms/strategies/", "/cms/view/",
        "/cms/controllers/", "/control/views/", "/control/addresses/views/",
        "/control/articles/views/", "/control/categories/views/", "/control/clients/views/",
        "/control/deals/views/", "/control/partitions/views/", "/control/produces/views/",
        "/control/subcategories/views/", "/control/descriptions/views/", "/control/comment/views/",
        "/control/subscribers/views/", "/control/yandex/views/", "/control/subscriptions/views/");

    foreach ($arrPath as $path)
        if (includeClass($serverRoot . $path . $class . ".php"))
            return;
}

spl_autoload_register('classLoader');
