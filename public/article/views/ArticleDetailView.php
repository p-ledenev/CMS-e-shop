<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.08.13
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */

/* @property Article $article
 * @property ArticlePartition $partition
 * @property Captcha $captcha
 * @property Cart $cart
 */
class ArticleDetailView extends View
{
    protected $article;
    protected $partition;
    protected $comment;
    protected $captcha;
    protected $cart;

    public function __construct($article, $comment, $captcha, $cart, $partition = null)
    {
        $this->article = $article;
        $this->partition = $partition;
        $this->comment = $comment;
        $this->captcha = $captcha;
        $this->cart = $cart;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    public function getPartition()
    {
        return $this->partition;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }

    /* @return Article */
    public function getArticle()
    {
        return $this->article;
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
        include "articleDetailView.phtml";
    }
}