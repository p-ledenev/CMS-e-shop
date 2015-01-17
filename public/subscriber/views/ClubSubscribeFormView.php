<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:35
 */

/* @property SubscriptionType $subscriptionType */
class ClubSubscribeFormView extends SubscribeFormView
{
    protected $formTitle;
    protected $formAction;

    public function __construct($subscriber, $resultId, $parentId, $formTitle, $formAction)
    {
        parent::__construct($subscriber, $resultId, $parentId);

        $this->formTitle = $formTitle;
        $this->formAction = $formAction;
    }

    public function setFormTitle($formTitle)
    {
        $this->formTitle = $formTitle;
    }

    public function getFormTitle()
    {
        return $this->formTitle;
    }

    public function setFormAction($formAction)
    {
        $this->formAction = $formAction;
    }

    public function getFormAction()
    {
        return $this->formAction;
    }

    protected function echoBodyTemplate()
    {
        include "clubSubscribeFormView.phtml";
    }
}