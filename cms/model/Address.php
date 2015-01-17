<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 07.08.13
 * Time: 23:18
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal[] $dealList
 * @property Customer $customer;
 */
class Address extends PersistableEntity
{
    protected $customer;
    protected $city;
    protected $cIndex;
    protected $street;
    protected $house;
    protected $build;
    protected $flat;
    protected $phone;
    protected $inMoscow;
    protected $dopInfo;
    protected $fullAddress;
    protected $deposit;

    private $dealList;

    public function setDealList($dealList)
    {
        $this->dealList = $dealList;
    }

    public function getDealList()
    {
        if ($this->dealList)
            return $this->dealList;

        $arItems = $this->select("SELECT id FROM deal WHERE address=" . $this->id);

        $items = Array();
        foreach ($arItems as $arItem)
            $items[] = Deal::initEntityWithId("Deal", $arItem['id']);

        $this->dealList = $items;

        return $this->dealList;
    }

    public function setBuild($build)
    {
        $this->build = $build;
    }

    public function getBuild()
    {
        return $this->getValueFor("build");
    }

    public function setCIndex($cIndex)
    {
        $this->cIndex = $cIndex;
    }

    public function getCIndex()
    {
        return $this->getValueFor("cIndex");
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->getValueFor("city");
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /* @return Customer */
    public function getCustomer()
    {
        return $this->getValueFor("customer");
    }

    public function setDopInfo($dopInfo)
    {
        $this->dopInfo = $dopInfo;
    }

    public function getDopInfo()
    {
        return $this->getValueFor("dopInfo");
    }

    public function setFlat($flat)
    {
        $this->flat = $flat;
    }

    public function getFlat()
    {
        return $this->getValueFor("flat");
    }

    public function setFullAddress($fullAddress)
    {
        $this->fullAddress = $fullAddress;
    }

    public function getFullAddress()
    {
        return $this->getValueFor("fullAddress");
    }

    public function setHouse($house)
    {
        $this->house = $house;
    }

    public function getHouse()
    {
        return $this->getValueFor("house");
    }

    public function setInMoscow($inMoscow)
    {
        $this->inMoscow = $inMoscow;
    }

    public function getInMoscow()
    {
        return $this->getValueFor("inMoscow");
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->getValueFor("phone");
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getStreet()
    {
        return $this->getValueFor("street");
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO user_address (id, customer, city, c_index, street, house, build, flat, phone,
        in_moscow, dopinfo, full_address) VALUES ("
            . $this->id . ", '"
            . $this->customer->getId() . "', '"
            . $this->getSQLValueFor("city") . "', '"
            . $this->getSQLValueFor("cIndex") . "', '"
            . $this->getSQLValueFor("street") . "', '"
            . $this->getSQLValueFor("house") . "', '"
            . $this->getSQLValueFor("build") . "', '"
            . $this->getSQLValueFor("flat") . "', '"
            . $this->getSQLValueFor("phone") . "',' "
            . (($this->inMoscow) ? "1" : "0") . "', '"
            . $this->getSQLValueFor("dopInfo") . "', '"
            . $this->getSQLValueFor("fullAddress") . "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['customer']))
            $this->customer = Customer::initEntityWithId("Customer", $arItem['customer']);

        $this->setPostedValueFor("city", $arItem['city']);
        $this->setPostedValueFor("cIndex", $arItem['c_index']);
        $this->setPostedValueFor("street", $arItem['street']);
        $this->setPostedValueFor("house", $arItem['house']);
        $this->setPostedValueFor("build", $arItem['build']);
        $this->setPostedValueFor("flat", $arItem['flat']);
        $this->setPostedValueFor("phone", $arItem['phone']);
        $this->setPostedValueFor("inMoscow", ($arItem['in_moscow'] > 0) ? true : false);
        $this->setPostedValueFor("dopInfo", $arItem['dopinfo']);
        $this->setPostedValueFor("fullAddress", $arItem['full_address']);
    }

    public function updateEntity()
    {
        echo $this->toDetailString();

        $this->execute("UPDATE user_address SET"
            . " customer='" . $this->customer->getId()
            . "', city='" . $this->getSQLValueFor("city")
            . "', c_index='" . $this->getSQLValueFor("cIndex")
            . "', street='" . $this->getSQLValueFor("street")
            . "', house='" . $this->getSQLValueFor("house")
            . "', build='" . $this->getSQLValueFor("build")
            . "', flat='" . $this->getSQLValueFor("flat")
            . "', phone='" . $this->getSQLValueFor("phone")
            . "', in_moscow='" . (($this->inMoscow) ? "1" : "0")
            . "', dopinfo='" . $this->getSQLValueFor("dopInfo")
            . "', full_address='" . $this->getSQLValueFor("fullAddress")
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM user_address WHERE id = " . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getDealList(), "Address refered by deals: ");

        return $response;
    }

    public function toShortString()
    {
        $len = 30;
        $address = substr($this->configAddress(), 0, $len) . "...";

        return (strlen($this->configAddress()) <= $len) ? $this->configAddress() : $address;
    }

    public function toDetailString()
    {
        return $this->configAddress();
    }

    private function configAddress()
    {
        if ($this->getFullAddress())
            return $this->fullAddress;

        $index = ($this->cIndex) ? $this->cIndex . " " : "";
        $house = ($this->house) ? "д. " . $this->house : "";
        $build = ($this->build && $this->build != '-' && $this->build != ' ' && $this->build != 'нет') ? ", корп. " . $this->build : "";
        $flat = ($this->flat && $this->flat != '-' && $this->flat != ' ' && $this->flat != 'нет') ? ", кв. " . $this->flat : "";

        return $index . $this->city . ", ул." . $this->street . ", " . $house . $build . $flat;
    }

    public function getPersistTableName()
    {
        return "user_address";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("customer");
        $responseFullAddress = $this->isEmptyValueFor("fullAddress");

        $responseAddress = $this->isEmptyValueFor("city");
        $responseAddress .= $this->isEmptyValueFor("street");
        $responseAddress .= $this->isEmptyValueFor("house");

        $response .= (strlen($responseFullAddress) > 0 && strlen($responseAddress) > 0) ?
            $responseAddress : "";

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setDealList(null);
        $this->getDealList();
    }
}

;