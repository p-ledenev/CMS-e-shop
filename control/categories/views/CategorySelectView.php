<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 8:32
 * To change this template use File | Settings | File Templates.
 */

class CategorySelectView extends CompositeView
{
    /* @param CategoryFilter $filter */
    public function __construct($filter, $formName, $fieldName)
    {
        $categoryList = $filter->loadItemList("Category");

        foreach ($categoryList as $category)
            $this->viewList[] = new SelectView($formName, $fieldName, $category);
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <TABLE align='center' width='98%' cellpadding='5' cellspacing='5'>
        <TR><TD><FONT class='switch font17 color2'>Выбрать каталог</FONT></TD></TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "
        </TABLE>
    ";
    }
}

;