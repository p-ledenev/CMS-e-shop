<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 7:45
 * To change this template use File | Settings | File Templates.
 */

/* @property Category $category
 * @property ArticlePartition $partition
 */
class ArticleFilter extends Filter
{
    protected $category;
    protected $partition;
    protected $articleTitle;

    public function __construct($url, $category, $partition, $articleTitle = null)
    {
        parent::__construct($url);

        $this->category = $category;
        $this->partition = $partition;
        $this->articleTitle = $articleTitle;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    public function getPartition()
    {
        return $this->partition;
    }

    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;
    }

    public function getArticleTitle()
    {
        return $this->articleTitle;
    }

    public function setFilter($cdata)
    {
        $this->category = Category::initEntityWithId("Category", $cdata['category_id']);
        $this->articleTitle = $cdata['article_title'];

        if ($cdata['partition'][$this->category->getId()] > 0)
            $this->partition = ArticlePartition::initEntityWithId("ArticlePartition", $cdata['partition'][$this->category->getId()]);
        else
            $this->partition = null;
    }

    protected function buildQuery()
    {
        $response = ($this->category) ? " AND p.category=" . $this->category->getId() : "";
        $response .= ($this->partition) ? " AND p.id=" . $this->partition->getId() : "";

        $response = ($this->articleTitle) ? " AND items.title LIKE '%" . $this->getSQLValueFor("articleTitle") . "%'" : $response;

        $response = " FROM article AS items INNER JOIN partition AS p ON p.id=items.partition WHERE 1" . $response . " ORDER BY items.sort ASC";

        return $response;
    }
}