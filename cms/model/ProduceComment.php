<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 9:15
 */

/* @property Produce produce */
class ProduceComment extends Comment
{
    protected $produce;

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    /* @return Produce */
    public function getProduce()
    {
        return $this->getValueFor("produce");
    }

    /* @return CommentType */
    protected function getType()
    {
        return CommentType::$toProduce;
    }

    public function getItem()
    {
        return $this->getProduce();
    }

    public function setItem($item)
    {
        $this->produce = $item;
    }

    protected function fillEntityByArray($arItem)
    {
        parent::fillEntityByArray($arItem);

        if ($arItem['item'])
            $this->produce = Produce::initEntityWithId("Produce", $arItem['item']);
    }
}