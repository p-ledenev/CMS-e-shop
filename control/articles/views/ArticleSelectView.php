<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 8:32
 * To change this template use File | Settings | File Templates.
 */

class ArticleSelectView extends CompositeView
{
    /* @param ArticleFilter $filter */
    public function __construct($filter, $formName, $fieldName)
    {
        /* @var Article[] $articleList */
        $articleList = $filter->loadItemList("Article");

        foreach ($articleList as $article)
            $this->viewList[] = new SelectView($formName, $fieldName, $article);
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <TABLE align='center' width='98%' cellpadding='5' cellspacing='5'>
        <TR><TD><FONT class='switch font17 color2'>Выбрать статью</FONT></TD></TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "
        </TABLE>
    ";
    }
}

;