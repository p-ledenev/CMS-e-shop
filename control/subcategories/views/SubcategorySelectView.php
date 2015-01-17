<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 8:32
 * To change this template use File | Settings | File Templates.
 */
class SubcategorySelectView extends CompositeView
{
    /* @param SubcategoryFilter $filter */
    public function __construct($filter, $formName, $fieldName)
    {
        $subcategoryList = $filter->loadItemList("Subcategory");

        foreach ($subcategoryList as $subcategory)
            $this->viewList[] = new SelectView($formName, $fieldName, $subcategory);
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <TABLE align='center' width='98%' cellpadding='5' cellspacing='5'>
        <TR><TD><FONT class='switch font17 color2'>Выбрать подкаталог</FONT></TD></TR>
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