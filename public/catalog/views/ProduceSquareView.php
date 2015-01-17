<?php
/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 12.07.14
 * Time: 15:18
 */

/* @property Produce $produce
 * @property Partition $partition
 */
class ProduceSquareView extends View
{
    protected $produce;
    protected $partition;
    protected $showExternalBorders;
    protected $cartResultId;
    protected $inflowResultId;
    protected $index;
    protected $count;

    public function __construct($produce, $partition, $showExternalBorders, $cartResultId, $inflowResultId, $index, $count)
    {
        parent::__construct();

        $this->produce = $produce;
        $this->partition = $partition;
        $this->showExternalBorders = $showExternalBorders;
        $this->cartResultId = $cartResultId;
        $this->inflowResultId = $inflowResultId;
        $this->index = $index;
        $this->count = $count;
    }

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    public function setCartResultId($cartResultId)
    {
        $this->cartResultId = $cartResultId;
    }

    public function getCartResultId()
    {
        return $this->cartResultId;
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setInflowResultId($inflowResultId)
    {
        $this->inflowResultId = $inflowResultId;
    }

    public function getInflowResultId()
    {
        return $this->inflowResultId;
    }

    public function setShowExternalBorders($showExternalBorders)
    {
        $this->showExternalBorders = $showExternalBorders;
    }

    public function getShowExternalBorders()
    {
        return $this->showExternalBorders;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    public function getPartition()
    {
        return $this->partition;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        if ($this->index >= $this->count)
            return;

        include "produceSquareView.phtml";
    }
}