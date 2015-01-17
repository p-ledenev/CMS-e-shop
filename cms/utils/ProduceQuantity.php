<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 08.08.13
 * Time: 0:02
 * To change this template use File | Settings | File Templates.
 */

class ProduceQuantity extends Enum
{
    /* @var ProduceQuantity $presence */
    public static $presence;
    /* @var ProduceQuantity $wating */
    public static $wating;
    /* @var ProduceQuantity $absent */
    public static $absent;
    /* @var ProduceQuantity $everEnd */
    public static $everEnd;
    /* @var ProduceQuantity $unknown */
    public static $unknown;

    public static function enumerate()
    {
        self::$presence = new ProduceQuantity(1, Array("title" => "� �������", "color" => "FFE9AF"));
        self::$wating = new ProduceQuantity(0, Array("title" => "���������", "color" => "BCBCBC"));
        self::$absent = new ProduceQuantity(-1, Array("title" => "�����������", "color" => "FF7269"));
        self::$everEnd = new ProduceQuantity(-2, Array("title" => "���� � ������������", "color" => "FF7269"));
        self::$unknown = new ProduceQuantity(-3, "- - -");
    }
}

;