<?php

/**
 * Created by PhpStorm.
 * User: dk
 * Date: 07.01.14
 * Time: 19:00
 */
class PreviewDescription extends Description
{
    public static $type = "preview";

    protected function getType()
    {
        return PreviewDescription::$type;
    }

    public function toDetailString()
    {
        return substr($this->getDetail(), 0, 30) . " ...";
    }
}