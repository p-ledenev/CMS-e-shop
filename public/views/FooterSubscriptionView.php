<?php

/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 07.08.14
 * Time: 17:04
 */
class FooterSubscriptionView extends SubscribeFormView
{
    public function __construct($subscriber)
    {
        parent::__construct($subscriber, null, null);
    }

    protected function echoBodyTemplate()
    {
        include "footerSubscriptionView.phtml";
    }
}