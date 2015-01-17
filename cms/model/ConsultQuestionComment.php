<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 9:15
 */

/* @property ConsultQuestion question */
class ConsultQuestionComment extends Comment
{
    protected $question;

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /* @return ConsultQuestion */
    public function getQuestion()
    {
        return $this->getValueFor("question");
    }

    /* @return CommentType */
    protected function getType()
    {
        return CommentType::$toQuestion;
    }

    public function getItem()
    {
        return $this->getQuestion();
    }

    public function setItem($item)
    {
        $this->question = $item;
    }

    protected function fillEntityByArray($arItem)
    {
        parent::fillEntityByArray($arItem);

        if ($arItem['item'])
            $this->Question = ConsultQuestion::initEntityWithId("ConsultQuestion", $arItem['item']);
    }
}

;