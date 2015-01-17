<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:55
 */

/* @property Produce $produce */
class ClubInfoSubscribeFormController extends SubscribeFormController
{
    /* @return View */
    protected function processOnController()
    {
        return new ClubSubscribeFormView($this->getRealSubscriber(), Constants::$clubResultId, Constants::$mainBodyId,
            "вступайте в клуб вся аюрведа", "club_info_subscribe");
    }
}