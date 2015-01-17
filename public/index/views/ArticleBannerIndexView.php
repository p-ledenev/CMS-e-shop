<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 18.07.14
 * Time: 20:29
 */
class ArticleBannerIndexView extends BannerIndexView
{
    public function __construct($image, $articleId, $height, $border = Array(1, 1, 1, 1))
    {
        /* @var Article $article */
        $article = Article::initEntityWithId("Article", $articleId);

        if ($article->isPersisted())
            $url = $article->createUrl();

        parent::__construct($image, $url, $height, $border);
    }
} 