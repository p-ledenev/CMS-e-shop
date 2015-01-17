<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 16.10.13
 * Time: 7:31
 * To change this template use File | Settings | File Templates.
 */

class HTMLBinarySelectView extends HTMLSelectView {

    public function __construct($name, $isTrueSelected) {

        $arOptions = Array("1" => "Да","0" => "Нет");
        $selectedValue = ($isTrueSelected) ? "1" : "0";

        parent::__construct($name, $arOptions, $selectedValue);
    }
}