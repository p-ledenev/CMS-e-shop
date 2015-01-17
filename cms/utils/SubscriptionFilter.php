<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 7:26
 * To change this template use File | Settings | File Templates.
 */

/* @property SubscriptionType $subscriptionType
 * @property SubscriberType $subscriberType
 */
class SubscriptionFilter extends Filter
{
    private $confirmationCode;
    private $dateFrom;
    private $dateTo;
    private $subscriptionType;
    private $subscriberType;

    public function __construct($url, $subscriptionType = null, $subscriberType = null, $confiramtionCode = null, $dateFrom = null, $dateTo = null)
    {
        parent::__construct($url);

        $this->confirmationCode = $confiramtionCode;
        $this->dateFrom = ($dateFrom) ? $dateFrom : strtotime("01.01.2000");
        $this->dateTo = ($dateTo) ? $dateTo : time() + 24 * 60 * 60;
        $this->subscriptionType = ($subscriptionType) ? $subscriptionType : SubscriptionType::$unknown;
        $this->subscriberType = ($subscriberType) ? $subscriberType : SubscriberType::$unknown;
    }

    public function setConfirmationCode($confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    public function getConfirmationCode()
    {
        return $this->confirmationCode;
    }

    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    }

    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
    }

    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function setSubscriberType($subscriberType)
    {
        $this->subscriberType = $subscriberType;
    }

    public function getSubscriberType()
    {
        return $this->subscriberType;
    }

    public function setSubscriptionType($subscriptionType)
    {
        $this->subscriptionType = $subscriptionType;
    }

    public function getSubscriptionType()
    {
        return $this->subscriptionType;
    }

    public function setFilter($cdata)
    {
        if ($cdata['confirm_code'])
            $this->confirmationCode = $cdata['confirm_code'];

        if ($cdata['subscription_type'])
            $this->subscriptionType = SubscriptionType::getItemBy($cdata['subscription_type'], "SubscriptionType");

        if ($cdata['subscriber_type'])
            $this->subscriberType = SubscriberType::getItemBy($cdata['subscriber_type'], "SubscriberType");

        if ($cdata['date_from'])
            $this->dateFrom = strtotime($cdata['date_from']);

        if ($cdata['date_to'])
            $this->dateTo = strtotime($cdata['date_to']) + 24 * 60 * 60 - 1;
    }

    protected function buildQuery()
    {
        $response = " FROM subscription AS items WHERE 1";

        $response .= (!SubscriptionType::$unknown->equals($this->subscriptionType)) ? " AND type='" . $this->subscriptionType->getCode() . "'" : "";
        $response .= (!SubscriberType::$unknown->equals($this->subscriberType)) ? " AND subscriber_type='" . $this->subscriberType->getCode() . "'" : "";
        $response .= ($this->confirmationCode) ? " AND confirm_code='" . $this->confirmationCode . "'" : "";
        $response .= ($this->dateFrom) ? " AND date_create >= " . $this->dateFrom : "";
        $response .= ($this->dateTo) ? " AND date_create <= " . $this->dateTo : "";

        return $response . " ORDER BY items.id DESC";
    }
}