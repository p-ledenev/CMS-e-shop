<?php

/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 30.07.14
 * Time: 17:11
 */

/* @property SubscriptionItem[] $subscriptionList */
abstract class SubscriberEntity extends PersistableEntity
{
    protected $name;
    protected $email;
    protected $dateCreate;
    protected $phone;

    protected $subscriptionList;

    public function setSubscriptionList($subscriptionList)
    {
        $this->subscriptionList = $subscriptionList;
    }

    /* @return SubscriptionItem[] */
    public function getSubscriptionList()
    {
        if ($this->subscriptionList)
            return $this->subscriptionList;

        $arrItems = $this->select("SELECT id FROM subscription WHERE subscriber=" . $this->id . " AND subscriber_type='" . $this->getSubscriberType()->getCode() . "'");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = SubscriptionItem::initEntityWithId("SubscriptionItem", $item['id']);

        $this->subscriptionList = $items;

        return $this->subscriptionList;
    }

    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    }

    public function getDateCreate()
    {
        return $this->getValueFor("dateCreate");
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->getValueFor("name");
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->getValueFor("email");
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->getValueFor("phone");
    }

    public function isPersistedWithEmail()
    {
        if (!$this->getEmail())
            return false;

        $arItem = $this->select("SELECT id FROM " . $this->getPersistTableName() . " WHERE email='" . $this->getEmail() . "'");

        if (count($arItem) > 0)
            return true;

        return false;
    }

    public function initEntityByEmail()
    {
        $this->loaded = true;

        $arItem = $this->select("SELECT * FROM " . $this->getPersistTableName() . " WHERE email='" . $this->email . "'");

        if (!$arItem || count($arItem) <= 0)
            return;

        $this->id = $arItem[0]['id'];
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getSubscriptionList(), $this->getSubscriberType()->getCode() . " refered by subscriptions: ");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setSubscriptionList(null);
        $this->getSubscriptionList();
    }

    /* @var SubscriptionItem $item */
    public function removeSubscriptionItem($item)
    {
        $this->setSubscriptionList($item->removeFrom($this->getSubscriptionList()));
    }

    /* @return SubscriberType */
    abstract public function getSubscriberType();
} 