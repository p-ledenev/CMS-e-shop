<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 08.08.13
 * Time: 0:50
 * To change this template use File | Settings | File Templates.
 */

class Paymethod extends Enum
{
    /* @var Paymethod $money */
    public static $money;
    /* @var Paymethod $bank */
    public static $bank;
    /* @var Paymethod $post */
    public static $post;
    /* @var Paymethod $ecomerce */
    public static $ecomerce;
    /* @var Paymethod $unknown */
    public static $unknown;

    public static function enumerate()
    {
        self::$money = new Paymethod(1, "���������");
        self::$bank = new Paymethod(2, "���������� �������");
        self::$post = new Paymethod(3, "���������� ������");
        self::$ecomerce = new Paymethod(4, "����������� ������");
        self::$unknown = new Paymethod(-2, "������ �� ���������");
    }
}

;
