<?php

/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 29.07.14
 * Time: 8:25
 */

/* @property PersistableEntity $item */
abstract class Subscription
{
    protected $item;
    protected $active;
    protected $confirmationCode;
    protected $dateCreate;

    public static function createFor($typeCode)
    {
        $type = SubscriptionType::getItemBy($typeCode, "SubscriptionType");

        if (SubscriptionType::$toNews->equals($type))
            return new NewsSubscription();

        if (SubscriptionType::$toClubInfo->equals($type))
            return new ClubInfoSubscription();

        if (SubscriptionType::$toProduce->equals($type))
            return new ProduceSubscription();

        if (SubscriptionType::$toClubActivity->equals($type))
            return new ClubActivitySubscription();

        if (SubscriptionType::$toClubWorkshop->equals($type))
            return new ClubWorkshopSubscription();

        if (SubscriptionType::$toClubSales->equals($type))
            return new ClubSalesSubscription();
    }

    public function __construct()
    {
        $this->item = PersistableEntity::initEntity("Produce");
        $this->active = true;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setConfirmationCode($confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    public function getConfirmationCode()
    {
        return $this->confirmationCode;
    }

    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    }

    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    public function setItem($item)
    {
        $this->item = $item;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function initItemProperty($id)
    {
        if (isset($id))
            $this->fillItemPropertyBy($id);
    }

    public function getErrorMessage()
    {
        return "Ваша подписка уже существует";
    }

    /* @return SubscriptionType */
    public abstract function getType();

    protected abstract function fillItemPropertyBy($id);

    public abstract function sendNotificationTo($email);
}