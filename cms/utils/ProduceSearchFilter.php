<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 7:45
 * To change this template use File | Settings | File Templates.
 */
class ProduceSearchFilter extends Filter
{
    protected $produceTitle;
    protected $quantity;

    public function __construct($url, $produceTitle, $quantity = true)
    {
        parent::__construct($url);

        $this->produceTitle = $produceTitle;
        $this->quantity = $quantity;
    }

    public function setFilter($cdata)
    {
        $this->produceTitle = $cdata['produce_title'];
    }

    protected function buildQuery()
    {
        $response = ($this->quantity) ? " AND items.quantity >= 0" : "";
        $response .= ($this->produceTitle) ? " AND items.title LIKE '%" . $this->getSQLValueFor("produceTitle") . "%'" : "";

        $response = " FROM catalog AS items WHERE 1" . $response . " ORDER BY items.sort ASC";

        return $response;
    }
}