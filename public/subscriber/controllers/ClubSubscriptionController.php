<?php

/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 05.08.14
 * Time: 9:02
 */
abstract class ClubSubscriptionController extends SubscriptionController
{
    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailTheme($subscriptionItem)
    {
        return "Клуб Вся Аюрведа";
    }
} 