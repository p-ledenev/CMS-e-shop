<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

/* @property Article $article */
class ArticleTableView extends View
{
    private $article;

    public function __construct($article)
    {
        $this->article = $article;
    }

    public function setarticle($article)
    {
        $this->article = $article;
    }

    public function getarticle()
    {
        return $this->article;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $article = $this->article;
        echo "
            <TR onMouseOut='this.style.background=\"\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
            <TD>" . $article->getSort() . "</TD>
            <TD>" . date("d.m.Y", $article->getDate()) . "</TD>
            <TD>" . $article->getPartition()->getName() . "</TD>
            <TD><A href='/control/articles/insert.php?id=" . $article->getId() . "'>" . $article->getTitle() . "</TD>
            <TD>
            <A onClick=\"delConfirm('/control/articles/?delete=yes&article_id=" . $article->getId() . "', '¬ы действительно хотите удалить материал?'); return false;\"
                href='javascript:void(0)'><FONT class='date red'>del</FONT></TD>
            </TR>
        ";
    }
}