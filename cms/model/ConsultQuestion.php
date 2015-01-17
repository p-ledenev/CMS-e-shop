<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 9:15
 */

/* @property ConsultQuestionComment[] commentList */
class ConsultQuestion extends Comment
{
    protected $commentList;

    public function setCommentList($commentList)
    {
        $this->commentList = $commentList;
    }

    /* @return ConsultQuestionComment[] */
    public function getCommentList()
    {
        if ($this->commentList)
            return $this->commentList;

        $arrItems = $this->select("SELECT c.id AS id FROM comment AS c
                                   WHERE c.item=" . $this->id . " AND type=" . CommentType::$toQuestion->getCode());

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = ConsultQuestionComment::initEntityWithId("ConsultQuestionComment", $item['id']);

        $this->commentList = $items;

        return $this->commentList;
    }

    /* @return CommentType */
    protected function getType()
    {
        return CommentType::$question;
    }

    public function getItem()
    {
        return -1;
    }

    public function setItem($item)
    {
    }
}