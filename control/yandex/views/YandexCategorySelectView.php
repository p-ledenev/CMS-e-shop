<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 8:32
 * To change this template use File | Settings | File Templates.
 */

class YandexCategorySelectView extends CompositeView
{
    /* @param SubcategoryFilter $filter */
    public function __construct($filter, $formName, $fieldName)
    {
        $categoryList = $filter->loadItemList("YandexCategory");

        foreach ($categoryList as $category)
            $this->viewList[] = new SelectView($formName, $fieldName, $category);
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <TABLE align='center' width='98%' cellpadding='5' cellspacing='5'>
        <TR><TD><FONT class='switch font17 color2'>Выбрать яндекс каталог</FONT></TD></TR>
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