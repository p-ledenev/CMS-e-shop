<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

/* @property SubscriptionItem $subscription */
class SubscriptionTableView extends View
{
    private $subscription;

    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
    }

    public function getSubscription()
    {
        return $this->subscription;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $subscription = $this->subscription->getSubscription();
        $subscriber = $this->subscription->getSubscriber();

        $dateCreate = date("d.m.Y h:i:s", $subscription->getDateCreate());
        $subscriberHref = ($subscriber instanceof Customer) ? "clients" : "subscribers";
        $subscriberId = $subscriber->getId();
        $subscriberName = $subscriber->getName() . "<BR><SPAN style='font-size:10px; color:gray;'>" .
            $subscriber->getSubscriberType()->getParams()['title'] . "</SPAN>";

        $subscriptionId = $this->subscription->getId();
        $subscriptionType = $subscription->getType()->getParams();

        $arrItem = $this->getItemAsArray();

        echo "
            <TR onMouseOut='this.style.background=\"\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
            <TD>$dateCreate</TD>
            <TD><A href='/control/$subscriberHref/insert.php?id=$subscriberId' style='text-decoration:none;'>$subscriberName</A></TD>
            <TD>$subscriptionType[title]</TD>
            <TD><A href='/control/$arrItem[href]/insert.php?id=$arrItem[id]' style='text-decoration:none;'>$arrItem[title]</A></TD>
            <TD>
            <A onClick=\"delConfirm('/control/subscriptions/?delete=yes&subscription_id=$subscriptionId', 'Вы действительно хотите удалить подписку?'); return false;\"
                href='javascript:void(0)'><FONT class='date red'>del</FONT>
            </TD>
            </TR>
        ";
    }

    protected function getItemAsArray()
    {
        $arrItem = Array();
        $item = $this->subscription->getSubscription()->getItem();

        if (!$item->isPersisted())
            return $arrItem;

        $arrItem['href'] = ($item instanceof Produce) ? "produces" : "articles";
        $arrItem['id'] = $item->getId();
        $arrItem['title'] = $item->getTitle();

        return $arrItem;
    }
}