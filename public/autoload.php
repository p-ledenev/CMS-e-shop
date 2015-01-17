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

    $arrPath = Array("/cms/model/", "/cms/utils/", "/cms/strategies/", "/cms/view/", "/cms/controllers/",
        "/public/views/", "/public/utils/", "/public/index/controllers/", "/public/index/views/",
        "/public/catalog/views/", "/public/catalog/controllers/", "/public/cart/views/",
        "/public/cart/controllers/", "/public/orders/views/", "/public/orders/controllers/",
        "/public/cabinet/views/", "/public/cabinet/controllers/", "/public/description/views/",
        "/public/comment/views/", "/public/captcha/views/", "/public/captcha/controllers/",
        "/public/search/views/", "/public/search/controllers/", "/public/subscriber/views/", "/public/subscriber/controllers/",
        "/public/club/views/", "/public/club/controllers/", "/public/article/views/", "/public/article/controllers/"
    );

    foreach ($arrPath as $path) {
        if (includeClass($serverRoot . $path . $class . ".php"))
            return;
    }
}

spl_autoload_register('classLoader');
