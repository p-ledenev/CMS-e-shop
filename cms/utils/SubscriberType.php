<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.02.14
 * Time: 8:48
 */
class SubscriberType extends Enum
{
    /* @var SubscriberType $subscriber */
    public static $subscriber;
    /* @var SubscriberType $customer */
    public static $customer;
    /* @var SubscriberType $unknown */
    public static $unknown;

    public static function enumerate()
    {
        self::$subscriber = new SubscriberType("subscriber", array("title" => "Подписчик", "class" => "Subscriber"));
        self::$customer = new SubscriberType("customer", array("title" => "Клиент", "class" => "Customer"));
        self::$unknown = new SubscriberType("unknown", array("title" => "- - -", "class" => ""));
    }
}