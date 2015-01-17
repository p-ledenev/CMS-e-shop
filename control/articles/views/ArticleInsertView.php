<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 9:38
 * To change this template use File | Settings | File Templates.
 */

/* @property Article $article */
class ArticleInsertView extends View
{
    private $article;

    public function __construct($article)
    {
        parent::__construct();

        $this->article = $article;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "articleInsertView.phtml";
    }
}