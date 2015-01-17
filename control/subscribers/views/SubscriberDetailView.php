<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 9:38
 * To change this template use File | Settings | File Templates.
 */

/* @property Subscriber $subscriber */
class SubscriberDetailView extends View
{
    private $subscriber;

    public function __construct($subscriber)
    {
        parent::__construct();

        $this->subscriber = $subscriber;
    }

    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function getSubscriber()
    {
        return $this->subscriber;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "subscriberDetailView.phtml";
    }
}