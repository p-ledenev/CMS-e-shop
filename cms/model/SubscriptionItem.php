<?php
/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 29.07.14
 * Time: 8:49
 */

/* @property SubscriberEntity $subscriber
 * @property Subscription $subscription
 */
class SubscriptionItem extends PersistableEntity
{
    protected $subscriber;
    protected $subscription;

    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /* @return SubscriberEntity */
    public function getSubscriber()
    {
        return $this->getValueFor("subscriber");
    }

    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
    }

    /* @return Subscription */
    public function getSubscription()
    {
        return $this->getValueFor("subscription");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->subscription = Subscription::createFor($arItem['type']);
        $this->subscription->initItemProperty($arItem['item']);
        $this->subscription->setConfirmationCode($arItem['confirm_code']);
        $this->subscription->setActive($arItem['active'] == "1" ? true : false);
        $this->subscription->setDateCreate($arItem['date_create']);

        $params = SubscriberType::getItemBy($arItem['subscriber_type'], "SubscriberType")->getParams();

        if ($arItem['subscriber'] > 0) {
            $this->subscriber = PersistableEntity::initEntityWithId($params['class'], $arItem['subscriber']);

        } else {
            $subscriber = PersistableEntity::initEntity($params['class']);
            /* @var SubscriberEntity $subscriber */
            $subscriber->fillEntityBy($arItem);
            $subscriber->initEntityByEmail();

            $this->subscriber = $subscriber;
        }
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO subscription (id, subscriber, item, confirm_code, active,
                        subscriber_type, type, date_create) VALUES ("
            . $this->id . ", '"
            . $this->subscriber->getId() . "', '"
            . $this->subscription->getItem()->getId() . "', '"
            . $this->subscription->getConfirmationCode() . "', '"
            . $this->subscription->getActive() . "', '"
            . $this->subscriber->getSubscriberType()->getCode() . "', '"
            . $this->subscription->getType()->getCode() . "', '"
            . time() . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE subscription SET"
            . " subscriber='" . $this->subscriber->getId()
            . " item='" . $this->subscription->getItem()->getId()
            . " confirm_code='" . $this->subscription->getConfirmationCode()
            . " active='" . $this->subscription->getActive()
            . " subscriber_type='" . $this->subscriber->getSubscriberType()->getCode()
            . "' type='" . $this->subscription->getType()->getCode()
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM subscription WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("subscriber");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
    }

    public function toShortString()
    {
        return $this->subscriber->getEmail() . " " . $this->subscription->getType()->getCode();
    }

    public function toDetailString()
    {
        return $this->subscriber->getEmail() . " " . $this->subscription->getType()->getCode();
    }

    public function getPersistTableName()
    {
        return "subscription";
    }

    public function generateConfirmationCode()
    {
        $this->subscription->setConfirmationCode($this->randString(10));
    }

    public function sendNotificationEmail()
    {
        $this->getSubscription()->sendNotificationTo($this->getSubscriber()->getEmail());
    }

    public function getErrorMessage() {
        return $this->getSubscription()->getErrorMessage();
    }
}