<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 08.08.13
 * Time: 0:02
 * To change this template use File | Settings | File Templates.
 */

class CategoryType extends Enum
{
    /* @var CategoryType $material */
    public static $material;
    /* @var CategoryType $market */
    public static $market;
    public static $all;
    public static $unknown;

    public static function enumerate()
    {
        self::$material = new  CategoryType(1, array("description" => "���������", "childType" => "ArticlePartition"));
        self::$market = new  CategoryType(0, array("description" => "�������", "childType" => "ProducePartition"));
        self::$all = new  CategoryType(-1, array("description" => "���"));
        self::$unknown = new ProduceQuantity(-2, array("description" => "��� �� ���������"));
    }
}

;