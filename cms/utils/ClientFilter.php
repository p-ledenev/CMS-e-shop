<?php

/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 19.08.13
 * Time: 23:18
 * To change this template use File | Settings | File Templates.
 */

/* @property ClientFilterProperty $filterProperty
 * @property ClientSortField $sortField
 * @property SortOrder $sortOrder
 * @property ClientAttribute $withAttribute
 * @property ClientAttribute $withoutAttribute
 */
class ClientFilter extends Filter
{
    private $fio;
    private $phone;
    private $email;
    private $mode;
    private $dateFrom;
    private $dateTo;
    private $countMin;
    private $countMax;
    private $discontMin;
    private $discontMax;
    private $amountMin;
    private $amountMax;
    private $withAttribute;
    private $withoutAttribute;
    private $filterProperty;
    private $sortField;
    private $sortOrder;

    public function setAmountMax($amountMax)
    {
        $this->amountMax = $amountMax;
    }

    public function getAmountMax()
    {
        return $this->amountMax;
    }

    public function setAmountMin($amountMin)
    {
        $this->amountMin = $amountMin;
    }

    public function getAmountMin()
    {
        return $this->amountMin;
    }

    public function setCountMax($countMax)
    {
        $this->countMax = $countMax;
    }

    public function getCountMax()
    {
        return $this->countMax;
    }

    public function setCountMin($countMin)
    {
        $this->countMin = $countMin;
    }

    public function getCountMin()
    {
        return $this->countMin;
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

    public function setDiscontMax($discontMax)
    {
        $this->discontMax = $discontMax;
    }

    public function getDiscontMax()
    {
        return $this->discontMax;
    }

    public function setDiscontMin($discontMin)
    {
        $this->discontMin = $discontMin;
    }

    public function getDiscontMin()
    {
        return $this->discontMin;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFio($fio)
    {
        $this->fio = $fio;
    }

    public function getFio()
    {
        return $this->fio;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setSortField($sortField)
    {
        $this->sortField = $sortField;
    }

    /* @return ClientSortField */
    public function getSortField()
    {
        return $this->sortField;
    }

    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function setWithAttribute($withAttribute)
    {
        $this->withAttribute = $withAttribute;
    }

    public function getWithAttribute()
    {
        return $this->withAttribute;
    }

    public function setWithoutAttribute($withoutAttribute)
    {
        $this->withoutAttribute = $withoutAttribute;
    }

    public function getWithoutAttribute()
    {
        return $this->withoutAttribute;
    }

    public function setFilterProperty($filterProperty)
    {
        $this->filterProperty = $filterProperty;
    }

    /* @return ClientFilterProperty */
    public function getFilterProperty()
    {
        return $this->filterProperty;
    }

    public function __construct($url, $mode = 'c')
    {
        parent::__construct($url);
        $this->mode = $mode;

        $this->sortField = ClientSortField::$byName;
        $this->sortOrder = SortOrder::$asc;

        $this->dateFrom = strtotime("01.01.2000");
        $this->dateTo = time() + 24 * 60 * 60;
        $this->filterProperty = ClientFilterProperty::$withReport;
    }

    public function setFilter($cdata)
    {
        $this->fio = (strlen($cdata['fio']) > 0) ? $cdata['fio'] : null;
        $this->phone = (strlen($cdata['phone']) > 0) ? $cdata['phone'] : null;
        $this->email = (strlen($cdata['email']) > 0) ? $cdata['email'] : null;

        $this->dateFrom = (strlen($cdata['date_from']) > 0) ? strtotime($cdata['date_from']) : null;
        $this->dateTo = (strlen($cdata['date_to']) > 0) ? strtotime($cdata['date_to']) : null;
        $this->countMin = (strlen($cdata['count_min']) > 0) ? $cdata['count_min'] : null;
        $this->countMax = (strlen($cdata['count_max']) > 0) ? $cdata['count_max'] : null;
        $this->discontMin = (strlen($cdata['discont_min']) > 0) ? $cdata['discont_min'] : null;
        $this->discontMax = (strlen($cdata['discont_max']) > 0) ? $cdata['discont_max'] : null;
        $this->amountMin = (strlen($cdata['amount_min']) > 0) ? $cdata['amount_min'] : null;
        $this->amountMax = (strlen($cdata['amount_max']) > 0) ? $cdata['amount_max'] : null;
        $this->withAttribute = (strlen($cdata['with_attribute']) > 0) ? ClientAttribute::getItemBy($cdata['with_attribute'], "ClientAttribute") : null;
        $this->withoutAttribute = (strlen($cdata['without_attribute']) > 0) ? ClientAttribute::getItemBy($cdata['without_attribute'], "ClientAttribute") : null;

        $this->filterProperty = (strlen($cdata['filter_property']) > 0)
            ? ClientFilterProperty::getItemBy($cdata['filter_property'], "ClientFilterProperty")
            : null;

        $this->sortField = ClientSortField::getItemBy($cdata['sort_field'], "ClientSortField");
        $this->sortOrder = SortOrder::getItemBy($cdata['sort_order'], "SortOrder");
    }

    protected function buildQuery()
    {
        $joinCondition = "INNER JOIN deal AS d ON items.id=d.customer";
        $havingCondition = "1";
        $whereCondition = "1";
        $queryFields = ", COUNT(d.id) AS deal_count";

        $whereCondition .= ($this->discontMin) ? " AND (items.current_discont >= '" . $this->discontMin . "')" : "";
        $whereCondition .= ($this->discontMax) ? " AND (items.current_discont <= '" . $this->discontMax . "')" : "";

        $whereCondition .= ($this->amountMin) ? " AND (d.amount_with_discont >= '" . $this->amountMin . "')" : "";
        $whereCondition .= ($this->amountMax) ? " AND (d.amount_with_discont <= '" . $this->amountMax . "')" : "";

        $whereCondition .= ($this->withAttribute && !$this->withAttribute->equals(ClientAttribute::$unknown)) ? " AND " . $this->withAttribute->getCode() . " = 1" : "";
        $whereCondition .= ($this->withoutAttribute && !$this->withAttribute->equals(ClientAttribute::$unknown)) ? " AND " . $this->withoutAttribute->getCode() . " <> 1" : "";

        $havingCondition .= ($this->countMin) ? " AND (deal_count >= '" . $this->countMin . "')" : "";
        $havingCondition .= ($this->countMax) ? " AND (deal_count <= '" . $this->countMax . "')" : "";

        if (ClientFilterProperty::$any->equals($this->filterProperty)) {

            $whereCondition .= ($this->dateFrom) ? " AND d.thedate >= " . $this->dateFrom : "";
            $whereCondition .= ($this->dateTo) ? " AND d.thedate <= " . ($this->dateTo + 24 * 60 * 60) : "";

        } else if (ClientFilterProperty::$newest->equals($this->filterProperty)) {

            $whereCondition .= ($this->dateFrom) ? " AND items.date_create >= " . $this->dateFrom : "";
            $whereCondition .= ($this->dateTo) ? " AND items.date_create <= " . ($this->dateTo + 24 * 60 * 60) : "";

        } else {

            $whereCondition .= ($this->dateFrom) ? " AND (items.date_create < " . $this->dateFrom : " AND (1";
            $whereCondition .= ($this->dateTo) ? (" OR items.date_create > " . ($this->dateTo + 24 * 60 * 60) . ")") : ")";

            $whereCondition .= ($this->dateFrom) ? " AND d.thedate >= " . $this->dateFrom : "";
            $whereCondition .= ($this->dateTo) ? " AND d.thedate <= " . ($this->dateTo + 24 * 60 * 60) : "";
        }

        if (!$this->countMax && !$this->countMin && !$this->amountMax && !$this->amountMin &&
            ClientFilterProperty::$newest->equals($this->filterProperty)
        ) {
            $havingCondition = "1";
            $whereCondition = "1";
            $joinCondition = "";
            $queryFields = "";
        }

        if (ClientFilterProperty::$withReport->equals($this->filterProperty)) {
            $havingCondition = "1";
            $whereCondition = "1";
            $joinCondition = "INNER JOIN poll_report AS p ON p.customer=items.id";
            $queryFields = "";
        }

        if ($this->fio) $whereCondition .= " AND name LIKE '%" . $this->fio . "%'";
        if ($this->phone) $whereCondition .= " AND phone LIKE '%" . $this->phone . "%'";
        if ($this->email) $whereCondition .= " AND email LIKE '%" . $this->email . "%'";

        $whereCondition .= ($this->mode == 'c') ?
            " AND (distribution IS NULL OR distribution='')" : " AND (distribution IS NOT NULL AND distribution<>'')";

        $query = " $queryFields FROM user AS items " . $joinCondition . " WHERE " . $whereCondition .
            " GROUP BY items.id HAVING " . $havingCondition .
            " ORDER BY " . $this->sortField->getCode() . " " . $this->sortOrder->getCode();

        return $query;
    }
}