<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 14.07.14
 * Time: 12:20
 */
class ClubActivitySubscriptionController extends ClubSubscriptionController
{
    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailBody($subscriptionItem)
    {
        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>
                    Приветствуем Вас в клубе проекта Вся Аюрведа!<BR>
                    Вы подписались на информацию о клубных мероприятиях.</DIV>";
    }

    /* @return SubscriptionType */
    protected function getSubscriptionType()
    {
        return SubscriptionType::$toClubActivity;
    }
}