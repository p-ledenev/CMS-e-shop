<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 14.07.14
 * Time: 20:01
 */

/* @property SubscriberEntity subscriber */
abstract class SubscribeFormView extends View
{
    protected $resultId;
    protected $parentId;
    protected $subscriber;

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setResultId($resultId)
    {
        $this->resultId = $resultId;
    }

    public function getResultId()
    {
        return $this->resultId;
    }

    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function getSubscriber()
    {
        return $this->subscriber;
    }

    public function __construct($subscriber, $resultId, $parentId)
    {
        $this->resultId = $resultId;
        $this->parentId = $parentId;
        $this->subscriber = $subscriber;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    public function allowFormFieldsEdit()
    {
        return $this->subscriber instanceof Subscriber;
    }
}