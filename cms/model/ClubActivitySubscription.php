<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.04.14
 * Time: 8:39
 */

class ClubActivitySubscription extends Subscription
{
    /* @return SubscriptionType */
    public function getType()
    {
        return SubscriptionType::$toClubActivity;
    }

    protected function fillItemPropertyBy($id)
    {
    }

    public function sendNotificationTo($email)
    {
    }
}