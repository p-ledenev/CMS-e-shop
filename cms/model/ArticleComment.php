<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 9:15
 */

/* @property Article article */
class ArticleComment extends Comment
{
    protected $article;

    public function setArticle($article)
    {
        $this->article = $article;
    }

    /* @return Article */
    public function getArticle()
    {
        return $this->getValueFor("article");
    }

    /* @return CommentType */
    protected function getType()
    {
        return CommentType::$toArticle;
    }

    public function getItem()
    {
        return $this->getArticle();
    }

    public function setItem($item)
    {
        $this->article = $item;
    }

    protected function fillEntityByArray($arItem)
    {
        parent::fillEntityByArray($arItem);

        if ($arItem['item'])
            $this->article = Article::initEntityWithId("article", $arItem['item']);
    }
}