<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:55
 */

/* @property Article $workshop */
class ClubWorkshopSubscribeFormController extends SubscribeFormController
{
    protected $workshop;

    public function __construct(&$request, $item)
    {
        parent::__construct($request);

        $this->workshop = Produce::initEntityWithId("Article", $item);
    }

    /* @return View */
    protected function processOnController()
    {
        return new ClubWorkshopSubscribeFormView($this->getRealSubscriber(), Constants::$clubResultId, Constants::$mainBodyId, $this->workshop);
    }
}