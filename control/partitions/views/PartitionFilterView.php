<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 22.08.13
 * Time: 17:27
 * To change this template use File | Settings | File Templates.
 */

/* @property PartitionFilter $filter
 * @property CategoryType $type
 */
class PartitionFilterView extends View
{
    private $filter;
    private $type;

    public function __construct($filter, $type)
    {
        $this->filter = $filter;
        $this->type = $type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
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
        include "partitionFilterView.phtml";
    }
}