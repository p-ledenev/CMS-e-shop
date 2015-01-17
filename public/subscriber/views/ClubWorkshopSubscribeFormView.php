<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:35
 */

/* @property Article $workshop */
class ClubWorkshopSubscribeFormView extends SubscribeFormView
{
    protected $workshop;

    public function setWorkshop($workshop)
    {
        $this->workshop = $workshop;
    }

    public function getWorkshop()
    {
        return $this->workshop;
    }

    public function __construct($subscriber, $resultId, $parentId, $workshop)
    {
        parent::__construct($subscriber, $resultId, $parentId);

        $this->workshop = $workshop;
    }

    protected function echoBodyTemplate()
    {
        include "clubWorkshopSubscribeFormView.phtml";
    }
}