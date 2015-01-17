<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */

class SubcategoryListTableView extends CompositeView
{
    public function __construct($subcategoryList, $url)
    {
        parent::__construct();

        foreach ($subcategoryList as $subcategory)
            $this->viewList[] = new SubcategoryTableView($subcategory, $url);

    }

    protected function echoHeaderTemplate()
    {
        echo
        "
        <TABLE width='98%' align='center' style='padding:0 0 10px 0;'>
        <TR>
        <TD>
            <FONT class='switch font17 color2'>Подкаталоги</FONT>
        </TD>
        </TR>
        </TABLE>
        <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH>Приоритет</TH>
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