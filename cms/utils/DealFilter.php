<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 7:45
 * To change this template use File | Settings | File Templates.
 */

/* @property DealStatus $status */
class DealFilter extends Filter
{
    private $status;
    private $mode;
    private $dateFrom;
    private $dateTo;

    public function __construct($url, $status, $mode, $dateFrom, $dateTo)
    {
        parent::__construct($url);

        $this->status = $status;
        $this->mode = $mode;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    }

    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
    }

    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setFilter($cdata)
    {
        $this->dateFrom = strtotime($cdata['date_from']);
        $this->dateTo = strtotime($cdata['date_to']) + 24 * 60 * 60 - 1;
        $this->status = DealStatus::getItemBy($cdata['status'], "DealStatus");
        $this->mode = $cdata['mode'];
    }

    protected function buildQuery()
    {
        $response = "1";
        $response .= ($this->dateFrom && $this->dateTo) ? " AND items.thedate >= " . $this->dateFrom . " AND items.thedate <= " . $this->dateTo : "";
        $response .= ($this->status != DealStatus::$all) ? " AND items.status=" . $this->getStatus()->getCode() : "";
        $response .= ($this->mode == "d") ? " AND c.distribution <> ''" : "";

        $response = " FROM deal AS items INNER JOIN user AS c ON c.id=items.customer WHERE " . $response . " ORDER BY thedate DESC";

        return $response;
    }
}