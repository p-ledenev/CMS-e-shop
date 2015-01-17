<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:35
 */

/* @property Produce $produce */
class ProduceSubscribeFormView extends SubscribeFormView
{
    protected $produce;

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    public function __construct($produce, $subscriber, $resultId, $parentId)
    {
        parent::__construct($subscriber, $resultId, $parentId);

        $this->produce = $produce;
    }

    protected function echoBodyTemplate()
    {
        include "produceSubscribeFormView.phtml";
    }
}