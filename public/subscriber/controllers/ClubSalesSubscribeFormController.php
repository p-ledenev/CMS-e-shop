<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:55
 */

class ClubSalesSubscribeFormController extends SubscribeFormController
{
    /* @return View */
    protected function processOnController()
    {
        return new ClubSalesSubscribeFormView($this->getRealSubscriber(), Constants::$clubResultId, Constants::$mainBodyId);
    }
}