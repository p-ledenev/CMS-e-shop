<?php

/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 08.08.13
 * Time: 0:32
 * To change this template use File | Settings | File Templates.
 */
abstract class Enum
{
    private $code;
    private $params;

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function __construct($code, $params)
    {
        $this->code = $code;
        $this->params = $params;
    }

    public static abstract function enumerate();

    public static function getItemBy($code, $className)
    {
        $items = Enum::getAllItems($className);

        /* @var Enum $item */
        foreach ($items as $item)
            if ($item->getCode() == $code) return $item;

        $class = new ReflectionClass($className);
        return $value = $class->getStaticPropertyValue("unknown");
    }

    public static function getAllItems($className)
    {
        $ref = new ReflectionClass($className);

        return $ref->getStaticProperties();
    }

    /* @param Enum $item */
    public function equals($item)
    {
        if (!$item)
            return false;

        if ($this->getCode() == $item->getCode())
            return true;

        return false;
    }
}

;