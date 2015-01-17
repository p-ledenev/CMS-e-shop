<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:55
 */

/* @property Produce $produce */
class ProduceSubscribeFormController extends SubscribeFormController
{
    protected $produce;

    public function __construct(&$request, $item)
    {
        parent::__construct($request);

        $this->produce = Produce::initEntityWithId("Produce", $item);
    }

    /* @return View */
    protected function processOnController()
    {
        return new ProduceSubscribeFormView($this->produce, $this->getRealSubscriber(), Constants::$inflowResultId, Constants::$mainBodyId);
    }
}