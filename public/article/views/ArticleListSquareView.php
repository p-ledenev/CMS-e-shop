<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 13.01.14
 * Time: 9:11
 */
class ArticleListSquareView extends CompositeView
{
    /* @param ArticlePartition $partition */
    public static function createFor($partition, $excludeArticle = null)
    {
        $articleList = $partition->getItemList();

        return new ArticleListSquareView($articleList, $excludeArticle);
    }

    /* @param Article $excludeArticle */
    public function __construct($articleList, $excludeArticle = null)
    {
        parent::__construct();

        /* @var Article $article */
        $index = 0;
        foreach ($articleList as  $article) {
            if (!$article->equals($excludeArticle))
                $this->viewList[] = new ArticleSquareView($article, $index++);
        }
    }

    protected function echoHeaderTemplate()
    {
        echo "<TABLE cellpadding='0' cellspacing='0' border='0' width='100%'><TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TR></TABLE>";
    }
}