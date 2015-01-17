<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.04.14
 * Time: 8:39
 */

class ClubInfoSubscription extends Subscription
{
    /* @return SubscriptionType */
    public function getType()
    {
        return SubscriptionType::$toClubInfo;
    }

    protected function fillItemPropertyBy($id)
    {
    }

    public function sendNotificationTo($email)
    {
    }
}