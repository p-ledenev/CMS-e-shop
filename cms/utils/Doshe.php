<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 11.06.14
 * Time: 8:30
 */

class Doshe extends Enum
{
    public static $vata;
    public static $pitta;
    public static $kapha;

    public static function enumerate()
    {
        self::$vata = new Doshe(1, Array("name"=>"Вата", "imageName" => "vata"));
        self::$pitta = new Doshe(2, Array("name"=>"Питта","imageName" => "pitta"));
        self::$kapha = new Doshe(3, Array("name"=>"Капха","imageName" => "capha"));
    }
}