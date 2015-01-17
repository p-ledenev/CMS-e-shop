<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 15.08.14
 * Time: 8:56
 */
class YandexProduceFilter extends EntitySimpleFilter
{
    protected function getEntityClassName()
    {
        return "YandexProduce";
    }

    protected function buildQuery()
    {
        $response = " FROM " . $this->getPersistTableName() . " AS items";

        return $response;
    }
}