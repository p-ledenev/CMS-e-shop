<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 26.02.14
 * Time: 8:09
 */

/* @property Comment $comment
 * @property Captcha $captcha;
 */
class CommentInsertView extends View
{
    protected $comment;
    protected $captcha;

    public function __construct($comment, $captcha)
    {
        $this->comment = $comment;
        $this->captcha = $captcha;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setCaptcha($captcha)
    {
        $this->captcha = $captcha;
    }

    public function getCaptcha()
    {
        return $this->captcha;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "commentInsertView.phtml";
    }
}