<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 30.06.14
 * Time: 8:32
 */

/* @property PollQuestion $question
 * @property PollAnswer $answer
 * @property Customer $customer
 */
class PollReport extends PersistableEntity
{
    protected $question;
    protected $answer;
    protected $customer;
    protected $date;

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->getValueFor("date");
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /* @return PollAnswer */
    public function getAnswer()
    {
        return $this->getValueFor("answer");
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

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /* @return PollQuestion */
    public function getQuestion()
    {
        return $this->getValueFor("question");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->question = PollQuestion::initEntityWithId("PollQuestion", $arItem['question']);
        $this->customer = Customer::initEntityWithId("Customer", $arItem['customer']);
        $this->answer = PollAnswer::initEntityWithId("PollAnswer", $arItem['answer']);
        $this->date = $arItem['date'];
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO poll_report (id, question, answer, customer, date)
            VALUES ("
            . $this->id . ", '"
            . $this->question->getId() . ", '"
            . $this->answer->getId() . ", '"
            . $this->customer->getId() . ", '"
            . $this->getValueFor("date") . "')");
    }

    public function updateEntity()
    {
        $this->execute("UPDATE poll_report SET"
            . " question='" . $this->question->getId() . "'"
            . ", answer='" . $this->answer->getId() . "'"
            . ", customer='" . $this->customer->getId() . "'"
            . ", date='" . $this->getSQLValueFor("date") . "'");
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM poll_answer2question WHERE id=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        return "";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("question");
        $response .= ($this->question && $this->question->getId() < 0) ? "question is empty<BR>" : "";

        $response .= $this->isEmptyValueFor("answer");
        $response .= ($this->answer && $this->answer->getId() < 0) ? "answer is empty<BR>" : "";

        $response .= $this->isEmptyValueFor("customer");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
    }

    public function toShortString()
    {
        return $this->getId();
    }

    public function toDetailString()
    {
        return $this->question->getQuestion() . ": " . $this->answer->getAnswer();
    }

    public function getPersistTableName()
    {
        return "poll_report";
    }
}