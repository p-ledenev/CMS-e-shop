<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 17.08.13
 * Time: 15:56
 * To change this template use File | Settings | File Templates.
 */

class Logger
{
    public static function dumpVar($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}

;