<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 8:43
 */

abstract class Comment extends PersistableEntity
{
    protected $date;
    protected $name;
    protected $email;
    protected $comment;

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->getValueFor("comment");
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->getValueFor("date");
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->getValueFor("email");
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->getValueFor("name");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->date = time();

        $this->setPostedValueFor("date", $arItem['date']);
        $this->setPostedValueFor("name", $arItem['name']);
        $this->setPostedValueFor("email", $arItem['email']);
        $this->setPostedValueFor("comment", $arItem['comment']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO comment (id, date, item, name, email, comment, type) VALUES ("
            . $this->id . ", '"
            . $this->getSQLValueFor("date") . "', '"
            . $this->getItem()->getId() . "', '"
            . $this->getSQLValueFor("name") . "', '"
            . $this->getSQLValueFor("email") . "', '"
            . $this->getSQLValueFor("comment") . "', '"
            . $this->getType()->getCode() . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE comment SET"
            . " date='" . $this->getSQLValueFor("date")
            . "', item='" . $this->getItem()->getId()
            . "', name='" . $this->getSQLValueFor("name")
            . "', email='" . $this->getSQLValueFor("email")
            . "', commnet='" . $this->getSQLValueFor("commnet")
            . "', type='" . $this->getType()->getCode()
            . "' WHERE id=" . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM comment WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
    }

    protected function initEntityReferencesByIdFromDB()
    {
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("name");
        $response .= $this->isEmptyValueFor("comment");

        return $response;
    }

    public function toShortString()
    {
        return $this->getName();
    }

    public function toDetailString()
    {
        return $this->name . " " . $this->comment;
    }

    public function getPersistTableName()
    {
        return "comment";
    }

    /* @return CommentType */
    protected abstract function getType();

    /* @return PersistableEntity */
    public abstract function getItem();

    public abstract function setItem($item);
}