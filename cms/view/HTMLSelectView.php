<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 16.10.13
 * Time: 7:24
 * To change this template use File | Settings | File Templates.
 */

class HTMLSelectView extends View
{
    protected $arOptions;
    protected $selectedValue;
    protected $name;
    protected $addEmptyValue;
    protected $width;

    /* @param PersistableEntity[] $entityList */
    public static function createFromEntityList($name, $entityList, $selectedId, $addEmptyValue = false, $width = "")
    {
        $arOptions = Array();
        foreach ($entityList as $entity)
            $arOptions[$entity->getId()] = $entity->toShortString();

        return new HTMLSelectView($name, $arOptions, $selectedId, $addEmptyValue, $width);
    }

    public function __construct($name, $arOptions, $selectedValue, $addEmptyValue = false, $width = "")
    {
        $this->name = $name;
        $this->arOptions = $arOptions;
        $this->selectedValue = $selectedValue;
        $this->addEmptyValue = $addEmptyValue;
        $this->width = $width;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo "<SELECT style='width:" . $this->width . ";' class='input' name='" . $this->name . "'>";

        if ($this->addEmptyValue) {
            $selected = ($this->selectedValue == null || $this->selectedValue <= 0) ? "selected" : "";
            echo "<OPTION value='-27' $selected>- - -</OPTION>";
        }

        foreach ($this->arOptions as $value => $name) {
            $selected = ($this->selectedValue == $value) ? "selected" : "";
            echo "<OPTION value='$value' $selected>$name</OPTION>";
        }

        echo "</SELECT>";
    }
}