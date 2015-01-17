<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 07.04.14
 * Time: 8:44
 */

class LargeSearchResultView extends SearchView
{
    protected function echoBodyTemplate()
    {
        echo "<DIV style='height:350px; vertical-align: top;'>Результатов слишком много, уточните запрос</DIV>";
    }
}