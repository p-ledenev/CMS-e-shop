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
        self::$toProduce = new SubscriptionType("toProduce", array("title" => "О поступлении продукта"));
        self::$toNews = new SubscriptionType("toNews", array("title" => "На новости магазина"));
        self::$toClubInfo = new SubscriptionType("toClubInfo", array("title" => "На клубную информацию"));
        self::$toClubWorkshop = new SubscriptionType("toClubWorkshop", array("title" => "На клубный семинар"));
        self::$toClubActivity = new SubscriptionType("toClubActivity", array("title" => "О клубных семинарах"));
        self::$toClubSales = new SubscriptionType("toClubSales", array("title" => "О клубных распродажах"));
        self::$unknown = new SubscriptionType("unknown", array("title" => "- - -"));
    }
}