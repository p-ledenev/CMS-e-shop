<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 17.04.14
 * Time: 8:35
 */

/* @property Produce $produce */
class ProduceSubscribeView extends View
{
    protected $produce;
    protected $resultId;
    protected $parentId;

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setResultId($resultId)
    {
        $this->resultId = $resultId;
    }

    public function getResultId()
    {
        return $this->resultId;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    public function __construct($produce, $resultId, $parentId)
    {
        parent::__construct();

        $this->produce = $produce;
        $this->resultId = $resultId;
        $this->parentId = $parentId;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "produceSubscribeView.phtml";
    }
}