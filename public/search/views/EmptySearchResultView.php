<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 07.04.14
 * Time: 8:44
 */

class EmptySearchResultView extends SearchView
{
    protected function echoBodyTemplate()
    {
        echo "<DIV style='height:350px; vertical-align: top;'>Ничего не найдено</DIV>";
    }
}