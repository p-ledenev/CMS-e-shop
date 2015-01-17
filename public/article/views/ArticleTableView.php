<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 13.01.14
 * Time: 9:13
 */

/* @property Article $article */
class ArticleTableView extends View
{
    protected $article;

    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function __construct($article)
    {
        $this->article = $article;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $image = new Image($this->article->getId(), ImageType::$articlePreview, $this->article->getTitle(), $this->article->createUrl());
        $articleId = $this->getArticle()->getId();

        $title = $this->article->getTitle();
        $preview = $this->article->getPreview();
        $detail = $this->article->getDetail();

        if ($image->exist())
            $imageView = "<A target='_blank' href='" . $this->article->createUrl() . "'><IMG border='0' width='100px' src='" . $image->getThumbUrl() . "'</A>";

        echo "<TR>
                <TD style='vertical-align:top; padding:10px 0 10px 0; width:120px;'>$imageView</TD>
                <TD style='padding:10px 0 10px 0; vertical-align: top;'>
                <A style='font-size:16px;' class='color_marsh' href='javascript:void(0);'
                   onclick='changeDisplayOptionFor(\"article_detail_$articleId\"); return false;'>$title</A><BR>
                <A style='font-size:14px;' class='color_warmgray' href='javascript:void(0);'
                   onclick='changeDisplayOptionFor(\"article_detail_$articleId\"); return false;'>$preview</A>
                </TD>
              </TR>
              <TR>
                <TD colspan='2' id='article_detail_$articleId' style='display:none; font-size:14px;' class='color_warmgray'>$detail</TD>
              </TR>";
    }
}