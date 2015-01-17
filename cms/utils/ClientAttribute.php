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
        self::$isCalled = new ClientAttribute("is_called", "������ �������");
        self::$isWelcomeLetter = new ClientAttribute("is_welcome_letter", "�������������� ������");
        self::$isFirstDealLetter = new ClientAttribute("is_first_deal_letter", "������ � ������� ������");
        self::$isFirstDealSMS = new ClientAttribute("is_first_deal_sms", "��� ����� ������� ������");
        self::$isBirthdayPresent = new ClientAttribute("is_birthday_present", "������� �� ��� ��������");
        self::$isAnniversaryCoupon = new ClientAttribute("is_anniversary_coupon", "����� � ���������");
        self::$inMailing = new ClientAttribute("in_mailing", "���������� ��������");
        self::$unknown = new ClientAttribute("-1", "---");
    }
}