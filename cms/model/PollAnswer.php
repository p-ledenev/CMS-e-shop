<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 30.06.14
 * Time: 8:08
 */

/* @property PollQuestion[] $questionList
 * @property PollReport[] reportList
 */
class PollAnswer extends PersistableEntity
{
    protected $answer;
    protected $reportList;
    protected $questionList;

    public function setQuestionList($questionList)
    {
        $this->questionList = $questionList;
    }

    public function getQuestionList()
    {
        if ($this->questionList)
            return $this->questionList;

        $arrItems = $this->select("SELECT question FROM poll_answer2question
                                   WHERE answer=" . $this->id . " ORDER BY date DESC");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = PollQuestion::initEntityWithId("PollQuestion", $item['question']);

        $this->questionList = $items;

        return $this->questionList;
    }
    
    public function setReportList($reportList)
    {
        $this->reportList = $reportList;
    }

    public function getReportList()
    {
        if ($this->reportList)
            return $this->reportList;

        $arrItems = $this->select("SELECT id FROM poll_report
                                   WHERE answer=" . $this->id . " ORDER BY date DESC");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = PollReport::initEntityWithId("PollReport", $item['id']);

        $this->reportList = $items;

        return $this->reportList;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    public function getAnswer()
    {
        return $this->getValueFor("answer");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->setPostedValueFor("answer", $arItem['answer']);
        $this->question = PollQuestion::initEntityWithId("PollQuestion", $arItem['question']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO poll_answer (id, question, answer)
            VALUES ("
            . $this->id . ", '"
            . $this->question->getId() . "', '"
            . $this->getAnswer() . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE poll_answer SET"
            . " question='" . $this->question->getId()
            . "', answer='" . $this->answer . "'");
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM poll_answer WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getReportList(), "Answer refered by reports: ");

        return $response;
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("answer");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setReportList(null);
        $this->getReportList();
    }

    public function toShortString()
    {
        return $this->answer;
    }

    public function toDetailString()
    {
        return $this->answer;
    }

    public function getPersistTableName()
    {
        return "poll_answer";
    }
}