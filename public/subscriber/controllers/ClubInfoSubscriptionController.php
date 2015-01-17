<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 14.07.14
 * Time: 12:20
 */
class ClubInfoSubscriptionController extends ClubSubscriptionController
{
    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailBody($subscriptionItem)
    {
        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>Приветствуем Вас в клубе проекта Вся Аюрведа!</DIV>";
    }

    /* @return SubscriptionType */
    protected function getSubscriptionType()
    {
        return SubscriptionType::$toClubInfo;
    }

    protected function getSuccessSubscribeInfo()
    {
        return "<img src='/images/join_us.jpg' border='0'>";
    }
}