<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 07.08.13
 * Time: 23:31
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer[] $userList */
class Usergroup extends PersistableEntity
{
    protected $name;
    protected $description;

    private $userList;

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->getValueFor("description");
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->getValueFor("name");
    }

    public function setUserList($userList)
    {
        $this->userList = $userList;
    }

    public function getUserList()
    {
        if ($this->userList)
            return $this->userList;

        $arItems = $this->select("SELECT user FROM user_usergroup WHERE ugroup=" . $this->id);

        $items = Array();
        foreach ($arItems as $arItem)
            $items[] = new User($arItem['user']);

        $this->userList = $items;

        return $this->userList;
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO user_group (id, name, description) VALUES ("
        . $this->id . ", '"
        . $this->name . "', '"
        . $this->getSQLValueFor("description") . "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->name = $arItem['name'];
        $this->description = $arItem['description'];
    }

    public function updateEntity()
    {
        $this->execute("UPDATE user_group SET"
        . " name='" . $this->name
        . "' description='" . $this->getSQLValueFor("description")
        . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM user_group WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getUserList(), "Usergroup refered by users: ");

        return $response;
    }

    public function toShortString()
    {
        return $this->getName();
    }

    public function toDetailString()
    {
        return $this->getName();
    }

    public function getPersistTableName()
    {
        return "user_group";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("name");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setUserList(null);
        $this->getUserList();
    }
}