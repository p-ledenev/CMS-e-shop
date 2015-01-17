<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 30.06.14
 * Time: 8:07
 */

/* @property PollAnswer $answerList */
class PollQuestion extends PersistableEntity
{
    protected $type;
    protected $question;
    protected $answerList;
    protected $poll;

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->getValueFor("type");
    }

    public function setAnswerList($answerList)
    {
        $this->answerList = $answerList;
    }

    public function getAnswerList()
    {
        if ($this->answerList)
            return $this->answerList;

        $arrItems = $this->select("SELECT answer FROM poll_answer2question
                                   WHERE answer=" . $this->id . " ORDER BY date DESC");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = PollAnswer::initEntityWithId("PollAnswer", $item['answer']);

        $this->answerList = $items;

        return $this->answerList;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getQuestion()
    {
        return $this->getValueFor("question");
    }

    public function setPoll($poll)
    {
        $this->poll = $poll;
    }

    public function getPoll()
    {
        return $this->getValueFor("poll");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->setPostedValueFor("question", $arItem['question']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO poll_question (id, question)
            VALUES ("
            . $this->id . ", '"
            . $this->getSQLValueFor("question") . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE poll_question SET"
            . " question='" . $this->getSQLValueFor("question") . "'");
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM poll_question WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getAnswerList(), "Question refered by answers: ");

        return $response;
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("question");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setAnswerList(null);
        $this->getAnswerList();
    }

    public function toShortString()
    {
        return $this->getQuestion();
    }

    public function toDetailString()
    {
        return $this->getQuestion();
    }

    public function getPersistTableName()
    {
        return "poll_question";
    }
}