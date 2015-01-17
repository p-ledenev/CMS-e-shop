<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 8:48
 */
class ClientFilterProperty extends Enum
{
    /* @var ClientFilterProperty $any */
    public static $any;
    /* @var ClientFilterProperty $existed */
    public static $existed;
    /* @var ClientFilterProperty $newest */
    public static $newest;
    /* @var ClientFilterProperty $withReport */
    public static $withReport;

    public static function enumerate()
    {
        self::$any = new ClientFilterProperty(1, "����� � ��������");
        self::$existed = new ClientFilterProperty(2, "����� ������������ � ��������");
        self::$newest = new ClientFilterProperty(3, "����� ����� + ��� �������");
        self::$withReport = new ClientFilterProperty(4, "� �������");
    }
}