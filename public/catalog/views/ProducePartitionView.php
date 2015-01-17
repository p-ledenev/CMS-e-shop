<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.08.13
 * Time: 9:28
 * To change this template use File | Settings | File Templates.
 */

/* @property ProduceFilter $filter */
class ProducePartitionView extends View
{
    protected $filter;
    protected $cartResultId;
    protected $inflowResultId;

    public function __construct($filter, $cartResultId, $inflowResultId)
    {
        $this->filter = $filter;
        $this->cartResultId = $cartResultId;
        $this->inflowResultId = $inflowResultId;
    }

    public function setInflowResultId($inflowResultId)
    {
        $this->inflowResultId = $inflowResultId;
    }

    public function getInflowResultId()
    {
        return $this->inflowResultId;
    }

    public function setCartResultId($resultId)
    {
        $this->cartResultId = $resultId;
    }

    public function getCartResultId()
    {
        return $this->cartResultId;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "producePartitionView.phtml";
    }
}