<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:35
 */

/* @property Article $workshop */
class ClubActivitySubscribeFormView extends SubscribeFormView
{
    protected $workshop;
    protected $display;

    public function setWorkshop($workshop)
    {
        $this->workshop = $workshop;
    }

    public function getWorkshop()
    {
        return $this->workshop;
    }

    public function setDisplay($display)
    {
        $this->display = $display;
    }

    public function getDisplay()
    {
        return $this->display;
    }

    public function __construct($subscriber, $workshop, $resultId, $parentId, $display = false)
    {
        parent::__construct($subscriber, $resultId, $parentId);

        $this->workshop = $workshop;
        $this->display = $display;
    }

    protected function echoBodyTemplate()
    {
        include "clubActivitySubscribeFormView.phtml";
    }
}