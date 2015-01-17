<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.04.14
 * Time: 8:39
 */
class ClubSalesSubscription extends Subscription
{
    /* @return SubscriptionType */
    public function getType()
    {
        return SubscriptionType::$toClubSales;
    }

    protected function fillItemPropertyBy($id)
    {
    }

    public function sendNotificationTo($email)
    {
    }
}