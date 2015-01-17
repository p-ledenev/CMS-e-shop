<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.04.14
 * Time: 9:30
 */
class Subscriber extends SubscriberEntity
{
    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->setPostedValueFor("name", $arItem['name']);
        $this->setPostedValueFor("email", $arItem['email']);
        $this->setPostedValueFor("phone", $arItem['phone']);

        $this->dateCreate = time();
        $this->setPostedValueFor("dateCreate", $arItem['date_create']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO subscriber (id, name, email, phone, date_create) VALUES ("
            . $this->id . ", '"
            . $this->getSQLValueFor("name") . "', '"
            . $this->getSQLValueFor("email") . "', '"
            . $this->getSQLValueFor("phone") . "', '"
            . $this->getSQLValueFor("dateCreate") . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE subscriber SET"
            . " name='" . $this->getSQLValueFor("name")
            . "', email='" . $this->getSQLValueFor("email")
            . "', phone='" . $this->getSQLValueFor("phone")
            . "' WHERE id=" . $this->getId());
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM subscriber WHERE id=" . $this->id);
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("name");
        $response .= $this->isEmptyValueFor("email");

        return $response;
    }

    public function toShortString()
    {
        return $this->getName() . " " . $this->getEmail();
    }

    public function toDetailString()
    {
        return $this->getName() . " " . $this->getEmail();
    }

    public function getPersistTableName()
    {
        return "subscriber";
    }

    /* @return SubscriberType */
    public function getSubscriberType()
    {
        return SubscriberType::$subscriber;
    }
}

;