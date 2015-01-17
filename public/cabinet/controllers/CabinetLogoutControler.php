<?php

/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 08.08.14
 * Time: 16:08
 */
class CabinetLogoutControler extends Controller
{
    /* @return View */
    protected function processOnController()
    {
        $manager = new CookieManager();
        $manager->removeSubscriberItemCookies();

        session_destroy();
        header("Location: http://$_SERVER[HTTP_HOST]");
    }
}