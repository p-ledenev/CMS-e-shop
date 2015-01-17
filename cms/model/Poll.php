<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 30.06.14
 * Time: 8:19
 */

/* @property PollQuestion[] $questionList */
class Poll extends PersistableEntity
{
    protected $name;
    protected $questionList;

    public function setQuestionList($questionList)
    {
        $this->questionList = $questionList;
    }

    public function getQuestionList()
    {
        if ($this->questionList)
            return $this->questionList;

        $arrItems = $this->select("SELECT id FROM poll_question
                                   WHERE poll=" . $this->id . " ORDER BY id");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = PollQuestion::initEntityWithId("PollQuestion", $item['id']);

        $this->questionList = $items;

        return $this->questionList;
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
        $this->setPostedValueFor("name", $arItem['name']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO poll (id, name)
            VALUES ("
            . $this->id . ", '"
            . $this->getSQLValueFor("name") . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE poll SET"
            . " name='" . $this->getSQLValueFor("name") . "'");
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM poll WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getQuestionList(), "Poll refered by questions: ");

        return $response;
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("name");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setQuestionList(null);
        $this->getQuestionList();
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
        return "poll";
    }
}