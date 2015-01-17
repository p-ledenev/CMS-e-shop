<?php

/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 08.08.13
 * Time: 0:02
 * To change this template use File | Settings | File Templates.
 */
class DealStatus extends Enum
{
    public static $reject;
    /* @var DealStatus $received */
    public static $received;
    public static $executed;
    public static $dispatch;
    public static $waiting;
    public static $accepted;
    public static $paid;
    public static $all;
    public static $unknown;

    public static function enumerate()
    {
        self::$reject = new DealStatus(-1, "�����");
        self::$received = new DealStatus(0, "��������");
        self::$executed = new DealStatus(1, "��������");
        self::$dispatch = new DealStatus(2, "������");
        self::$waiting = new DealStatus(3, "�������");
        self::$accepted = new DealStatus(4, "������");
        self::$paid = new DealStatus(5, "�������");
        self::$all = new DealStatus(-2, "���");
        self::$unknown = new DealStatus(-3, "������ �� ���������");
    }
}

;
