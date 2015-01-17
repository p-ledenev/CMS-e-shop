<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 16.06.14
 * Time: 8:40
 */
class SortOrder extends Enum
{
    public static $asc;
    public static $desc;

    public static function enumerate()
    {
        self::$asc = new SortOrder("asc", "по возрастанию");
        self::$desc = new SortOrder("desc", "по убыванию");
    }
}