<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 16.06.14
 * Time: 8:40
 */
class ClientAttribute extends Enum
{
    public static $unknown;
    public static $isCalled;
    public static $isWelcomeLetter;
    public static $isFirstDealLetter;
    public static $isFirstDealSMS;
    public static $isBirthdayPresent;
    public static $isAnniversaryCoupon;
    public static $inMailing;

    public static function enumerate()
    {
        self::$isCalled = new ClientAttribute("is_called", "Звонок клиенту");
        self::$isWelcomeLetter = new ClientAttribute("is_welcome_letter", "Приветственное письмо");
        self::$isFirstDealLetter = new ClientAttribute("is_first_deal_letter", "Письмо к первому заказу");
        self::$isFirstDealSMS = new ClientAttribute("is_first_deal_sms", "СМС после первого заказа");
        self::$isBirthdayPresent = new ClientAttribute("is_birthday_present", "Подарок ко дню рождения");
        self::$isAnniversaryCoupon = new ClientAttribute("is_anniversary_coupon", "Купон к годовщине");
        self::$inMailing = new ClientAttribute("in_mailing", "Отправлять рассылку");
        self::$unknown = new ClientAttribute("-1", "---");
    }
}