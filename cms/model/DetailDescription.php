<?php

/**
 * Created by PhpStorm.
 * User: dk
 * Date: 07.01.14
 * Time: 19:01
 */
class DetailDescription extends Description
{
    public static $type = "detail";

    protected function getType()
    {
        return DetailDescription::$type;
    }
}