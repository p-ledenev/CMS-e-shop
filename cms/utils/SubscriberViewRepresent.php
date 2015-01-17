<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 14.08.14
 * Time: 8:49
 */

/* @property SubscriberEntity $subscriber */
class SubscriberViewRepresent
{
    protected $subscriber;

    /* @var SubscriberEntity $subscriber */
    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function getName()
    {
        return $this->subscriber->getName() ? $this->subscriber->getName() : "ÈÌß";
    }

    public function getEmail()
    {
        return $this->subscriber->getEmail() ? $this->subscriber->getEmail() : "EMAIL";
    }

    public function getPhone()
    {
        return $this->subscriber->getEmail() ? $this->subscriber->getPhone() : "ÒÅËÅÔÎÍ";
    }

    public function getBlocked()
    {
        return $this->subscriber instanceof Subscriber ? "" : "disabled";
    }

    public function getOnClick()
    {
        return $this->subscriber->getName() ? "" : "onClick=\"this.value=''; return false;\"";
    }
} 