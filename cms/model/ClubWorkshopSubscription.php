<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.04.14
 * Time: 8:39
 */

class ClubWorkshopSubscription extends Subscription
{
    /* @return SubscriptionType */
    public function getType()
    {
        return SubscriptionType::$toClubWorkshop;
    }

    protected function fillItemPropertyBy($id)
    {
        $this->item = Article::initEntityWithId("Article", $id);
    }

    public function sendNotificationTo($email)
    {
    }

    public function getErrorMessage()
    {
        return "¬ы уже зарегистрированы на это меропри€тие";
    }
}