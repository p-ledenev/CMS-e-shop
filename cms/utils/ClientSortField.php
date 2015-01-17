<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 16.06.14
 * Time: 8:40
 */
class ClientSortField extends Enum
{
    public static $byName;
    public static $byDate;
    public static $byCount;

    public static function enumerate()
    {
        self::$byName = new ClientSortField ("items.name", "�� �����");
        self::$byDate = new ClientSortField ("items.date_create", "�� ����");
        self::$byCount = new ClientSortField ("deal_count", "�� ���-�� �������");
    }
}