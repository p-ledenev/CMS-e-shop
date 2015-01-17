<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 18.08.14
 * Time: 8:21
 */
class YandexCategoryParentView extends YandexCategoryView
{
    protected function echoBodyTemplate()
    {
        $name = $this->category->getName();
        $left = $this->countLeftPadding();

        echo "<DIV style='padding:5px 5px 5px $left; font-size:16px; color:#0066cc;'>
        $name
        </DIV>";
    }
}