<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 7:58
 * To change this template use File | Settings | File Templates.
 */

/* @property Partition $partititon */
class PartitionInsertView extends View
{
    protected $partititon;

    public function __construct($partititon)
    {
        $this->partititon = $partititon;
    }

    public function setPartititon($partititon)
    {
        $this->partititon = $partititon;
    }

    public function getPartititon()
    {
        return $this->partititon;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "partitionInsertView.phtml";
    }
}