<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 14.07.14
 * Time: 12:20
 */
class ClubWorkshopSubscriptionController extends ClubSubscriptionController
{
    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailBody($subscriptionItem)
    {
        /* @var Article $item */
        $item = $subscriptionItem->getSubscription()->getItem();

        $title = $item->getTitle();
        $url = "http://" . $_SERVER['HTTP_HOST'] . $item->createUrl();

        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>
                    Приветствуем Вас в клубе проекта Вся Аюрведа!<BR>
                    Вы записались на семинар $title<BR>
                    Подробности <A href='$url' style='color:#004C96; text-decoration: underline;'>по ссылке</A>
                    </DIV>";
    }

    /* @return SubscriptionType */
    protected function getSubscriptionType()
    {
        return SubscriptionType::$toClubWorkshop;
    }
}