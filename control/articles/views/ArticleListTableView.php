<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */


/* @property Article[] $articleList */
class ArticleListTableView extends CompositeView
{
    private $articleList;

    /* @param Article[] $articleList */
    public function __construct($articleList, $url)
    {
        parent::__construct();
        $this->articleList = $articleList;

        foreach ($articleList as $article)
            $this->viewList[] = new ArticleTableView($article, $url);

    }

    protected function echoHeaderTemplate()
    {
        echo
        "
    <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH>Приоритет</TH>
            <TH>Дата публикации</TH>
            <TH>Раздел</TH>
            <TH>Название</TH>
            <TH>&nbsp;</TH>
        </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}