<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */


class CategoryListTableView extends CompositeView
{
    public function __construct($categoryList, $url)
    {
        parent::__construct();

        foreach ($categoryList as $category)
            $this->viewList[] = new CategoryTableView($category, $url);

    }

    protected function echoHeaderTemplate()
    {
        echo
        "
        <DIV style='padding:20px 0 0 0;'></DIV>
        <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH>Приоритет</TH>
            <TH>Тип</TH>
            <TH>Название</TH>
            <TH>Url</TH>
            <TH>&nbsp;</TH>
        </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}