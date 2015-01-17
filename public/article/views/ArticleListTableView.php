<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 13.01.14
 * Time: 9:11
 */
class ArticleListTableView extends CompositeView
{
    public function __construct($articleList)
    {
        parent::__construct();

        foreach ($articleList as $article)
            $this->viewList[] = new ArticleTableView($article);
    }

    protected function echoHeaderTemplate()
    {
        echo "<TABLE cellpadding='0' cellspacing='0' border='0' width='100%'>
            <TR>
        <TD colspan='2'
            style='height: 30px; border-bottom-width: 1px; padding: 0px 0 0px 5px; font-size:20px;' class='bordercolor_lime color_lime'>
            —“¿“‹» Œ “Œ¬¿–≈
        </TD>
        <TR><TD>&nbsp;</TD></TR>
    </TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}