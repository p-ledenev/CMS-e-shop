<?php

/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 07.08.14
 * Time: 18:17
 */
abstract class SubscribeFormController extends Controller
{
    protected function getRealSubscriber()
    {
        if ($this->getCustomer()->isPersisted())
            return $this->getCustomer();

        return $this->getSubscriber();
    }
} 