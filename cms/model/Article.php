<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 08.08.13
 * Time: 17:37
 * To change this template use File | Settings | File Templates.
 */

/* @property Partition $partition
 * @property Article[] $programList
 * @property Article[] $inProgramList
 * @property Produce[] $produceList
 * @property ArticleComment[] $commentList
 */
class Article extends PersistableEntity
{
    protected $title;
    protected $date;
    protected $preview;
    protected $detail;
    protected $sort;
    protected $partition;

    protected $programList;
    protected $inProgramList;
    protected $produceList;
    protected $commentList;

    public function setCommentList($commentList)
    {
        $this->commentList = $commentList;
    }

    /* @return ArticleComment[] */
    public function getCommentList()
    {
        if ($this->commentList)
            return $this->commentList;

        $arrItems = $this->select("SELECT c.id AS id FROM comment AS c
                                   WHERE c.item=" . $this->id . " AND type=" . CommentType::$toArticle->getCode());

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = ProduceComment::initEntityWithId("ProduceComment", $item['id']);

        $this->commentList = $items;

        return $this->commentList;
    }

    public function setProduceList($produceList)
    {
        $this->produceList = $produceList;
    }

    public function getProduceList()
    {
        if ($this->produceList)
            return $this->produceList;

        $arrItems = $this->select("SELECT produce FROM catalog_prod2art
				                         WHERE article=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Produce::initEntityWithId("Produce", $item['produce']);

        $this->produceList = $items;

        return $this->produceList;
    }

    public function setProgramList($programList)
    {
        $this->programList = $programList;
    }

    public function getProgramList()
    {
        if ($this->programList)
            return $this->programList;

        $arrItems = $this->select("SELECT program FROM article_art2art WHERE article=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Article::initEntityWithId("Article", $item['program']);

        $this->programList = $items;

        return $this->programList;
    }

    public function setInProgramList($inProgramList)
    {
        $this->inProgramList = $inProgramList;
    }

    public function getInProgramList()
    {
        if ($this->inProgramList)
            return $this->inProgramList;

        $arrItems = $this->select("SELECT article FROM article_art2art WHERE program=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Article::initEntityWithId("Article", $item['article']);

        $this->programList = $items;

        return $this->programList;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->getValueFor("date");
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    public function getDetail()
    {
        return $this->getValueFor("detail");
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    /* @return Partition */
    public function getPartition()
    {
        return $this->getValueFor("partition");
    }

    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    public function getPreview()
    {
        return $this->getValueFor("preview");
    }

    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    public function getSort()
    {
        return $this->getValueFor("sort");
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->getValueFor("title");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['partition']))
            $this->partition = ArticlePartition::initEntityWithId("ArticlePartition", $arItem['partition']);

        if (is_numeric($arItem['date']) !== true)
            $arItem['date'] = strtotime($arItem['date']);

        $this->setPostedValueFor("title", $arItem['title']);
        $this->setPostedValueFor("date", $arItem['date']);
        $this->setPostedValueFor("preview", $arItem['preview']);
        $this->setPostedValueFor("detail", $arItem['detail']);
        $this->setPostedValueFor("sort", $arItem['sort']);

        if ($arItem['programs']) {
            $this->programList = Array();
            foreach ($arItem['program'] as $itemId)
                $this->programList[] = Article::initEntityWithId("Article", $itemId);
        }

        if ($arItem['produces']) {
            $this->produceList = Array();
            foreach ($arItem['produces'] as $itemId)
                $this->produceList[] = Produce::initEntityWithId("Produce", $itemId);
        }

        if ($arItem['program'])
            $this->programList[] = Article::initEntityWithId("Article", $arItem['program']);

        if ($arItem['produce'])
            $this->produceList[] = Produce::initEntityWithId("Produce", $arItem['produce']);
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO article (id, title, date, preview, detail, partition, sort) VALUES ("
            . $this->id . ", '"
            . $this->title . "', '"
            . $this->getSQLValueFor("date") . "', '"
            . $this->getSQLValueFor("preview") . "', '"
            . $this->getSQLValueFor("detail") . "', '"
            . $this->partition->getId() . "', '"
            . $this->getSQLValueFor("sort") . "')");

        $this->replacePrograms();
        $this->replaceProducePrograms();
    }

    public function updateEntity()
    {
        $this->execute("UPDATE article SET"
            . " title='" . $this->title
            . "', date='" . $this->getSQLValueFor("date")
            . "', preview='" . $this->getSQLValueFor("preview")
            . "', detail='" . $this->getSQLValueFor("detail")
            . "', partition='" . $this->partition->getId()
            . "', sort='" . $this->getSQLValueFor("sort")
            . "' WHERE id=" . $this->id);

        $this->replacePrograms();
        $this->replaceProducePrograms();
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM article WHERE id=" . $this->id);

        $this->removePrograms();
        $this->removeProducePrograms();
    }

    /* @var Produce $item */
    public function removeProduceProgramItem($item)
    {
        $this->setProduceList($item->removeFrom($this->produceList));
    }

    /* @var Article $item */
    public function removeProgramItem($item)
    {
        $this->setProgramList($item->removeFrom($this->programList));
    }

    protected function replacePrograms()
    {
        $this->removePrograms();

        foreach ($this->programList as $program)
            $this->execute("INSERT INTO article_art2art (article, program) VALUES (" . $this->id . ", " . $program->getId() . ")");
    }

    protected function replaceProducePrograms()
    {
        $this->removeProducePrograms();

        foreach ($this->produceList as $produce)
            $this->execute("INSERT INTO catalog_prod2art (produce, article) VALUES (" . $produce->getId() . ", " . $this->id . ")");
    }

    protected function removePrograms()
    {
        $this->execute("DELETE FROM article_art2art WHERE article=" . $this->id);
    }

    protected function removeProducePrograms()
    {
        $this->execute("DELETE FROM catalog_prod2art WHERE article=" . $this->id);
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getInProgramList(), "Article refered by articles: ", "<br><br>");
        $response .= $this->printList($this->getProduceList(), "Article refered by produces: ");

        return $response;
    }

    public function toShortString()
    {
        return $this->getTitle();
    }

    public function toDetailString()
    {
        return $this->getTitle();
    }

    public function getPersistTableName()
    {
        return "article";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("title");
        $response .= $this->isEmptyValueFor("sort");
        $response .= $this->isEmptyValueFor("date");

        $response .= (!$this->partition || $this->partition->getId() <= 0) ? "empty article partition<BR>" : "";

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setInProgramList(null);
        $this->setProduceList(null);
        $this->setProduceList(null);

        $this->getInProgramList();
        $this->getProduceList();
        $this->getProgramList();
    }

    public function createUrl()
    {
        return "/" . $this->getPartition()->getUrl() . "/" . $this->id;
    }
}

;