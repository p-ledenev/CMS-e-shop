<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 16.06.14
 * Time: 8:40
 */

class EffectDirection extends Enum
{
    public static $increese;
    public static $decreese;
    /* @var EffectDirection $unknown */
    public static $unknown;

    public static function enumerate()
    {
        self::$increese = new EffectDirection(1, Array("value" => "Повышает", "imageName" => "up"));
        self::$decreese = new EffectDirection(-1, Array("value" => "Понижает", "imageName" => "down"));
        self::$unknown = new EffectDirection(0, "---");
    }
}