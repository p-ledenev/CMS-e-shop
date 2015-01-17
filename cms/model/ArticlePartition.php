<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 18:48
 * To change this template use File | Settings | File Templates.
 */
class ArticlePartition extends Partition
{
    public function getItemList()
    {
        if ($this->itemList)
            return $this->itemList;

        $arrItems = $this->select("SELECT id FROM article WHERE partition=" . $this->id . " ORDER BY id DESC");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Article::initEntityWithId("Article", $item['id']);

        $this->itemList = $items;

        return $this->itemList;
    }
}