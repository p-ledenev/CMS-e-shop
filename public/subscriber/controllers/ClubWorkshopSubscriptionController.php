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
                    ������������ ��� � ����� ������� ��� �������!<BR>
                    �� ���������� �� ������� $title<BR>
                    ����������� <A href='$url' style='color:#004C96; text-decoration: underline;'>�� ������</A>
                    </DIV>";
    }

    /* @return SubscriptionType */
    protected function getSubscriptionType()
    {
        return SubscriptionType::$toClubWorkshop;
    }
}