<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 16:52
 * To change this template use File | Settings | File Templates.
 */

/* @var GiftAmount $amount1
 * @var GiftAmount $amount2
 * @var GiftAmount $amount3
 * @var GiftAmount $unknown
 */
class GiftAmount extends Enum
{
    public static $amount1;
    public static $amount2;
    public static $amount3;
    public static $unknown;

    public static function enumerate()
    {
        self::$amount1 = new GiftAmount("1", Array(100, 1000, "до 1000"));
        self::$amount2 = new GiftAmount("2", Array(1000, 5000, "1000-5000"));
        self::$amount3 = new GiftAmount("3", Array(5000, 150000, "свыше 5000"));
        self::$unknown = new GiftAmount("-1", Array(0, 0, "- - -"));
    }

    /* @return GiftAmount */
    public static function getItemByAmount($amount)
    {
        /* @var GiftAmount $item */
        foreach (GiftAmount::getAllItems("GiftAmount") as $item) {
            $itemList = $item->getParams();
            if ($amount >= $itemList[0] && $amount < $itemList[1])
                return $item;
        }
    }
}

;