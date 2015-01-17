<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 8:48
 */
class SubscriptionType extends Enum
{
    /* @var SubscriptionType $toProduce */
    public static $toProduce;
    /* @var SubscriptionType $toNews */
    public static $toNews;
    /* @var SubscriptionType $toClubInfo */
    public static $toClubInfo;
    /* @var SubscriptionType $toClubWorkshop */
    public static $toClubWorkshop;
    /* @var SubscriptionType $toClubActivity */
    public static $toClubActivity;
    /* @var SubscriptionType $toClubSales */
    public static $toClubSales;
    /* @var SubscriptionType $unknown */
    public static $unknown;

    public static function enumerate()
    {
        self::$toProduce = new SubscriptionType("toProduce", array("title" => "� ����������� ��������"));
        self::$toNews = new SubscriptionType("toNews", array("title" => "�� ������� ��������"));
        self::$toClubInfo = new SubscriptionType("toClubInfo", array("title" => "�� ������� ����������"));
        self::$toClubWorkshop = new SubscriptionType("toClubWorkshop", array("title" => "�� ������� �������"));
        self::$toClubActivity = new SubscriptionType("toClubActivity", array("title" => "� ������� ���������"));
        self::$toClubSales = new SubscriptionType("toClubSales", array("title" => "� ������� �����������"));
        self::$unknown = new SubscriptionType("unknown", array("title" => "- - -"));
    }
}