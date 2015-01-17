<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 16.06.14
 * Time: 8:40
 */
class PollQuestionType extends Enum
{
    public static $multi;
    public static $single;
    public static $text;
    /* @var PollQuestionType $unknown */
    public static $unknown;

    public static function enumerate()
    {
        self::$multi = new PollQuestionType("multi", "������������� �����");
        self::$single = new PollQuestionType("check", "��������� �����");
        self::$text = new PollQuestionType("text", "��������� �����");
        self::$unknown = new PollQuestionType("", "---");
    }
}