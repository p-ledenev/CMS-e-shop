<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

/* @property Category $category */
class CategoryTableView extends View
{
    private $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $category = $this->category;
        $arParams = $category->getType()->getParams();
        echo "
        <TR onMouseOut='this.style.background=\"\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
        <TD>" . $category->getSort() . "</TD>
            <TD>" . $arParams['description'] . "</TD>
            <TD><A href='/control/categories/insert.php?id=" . $category->getId() . "'>" . $category->getName() . "</A></TD>
            <TD><A target='_blank' href='/" . $category->getUrl() . "/'>" . $category->getUrl() . "</A></TD>
            <TD>
                <A class='date'style='color:#D43424' onClick=\"delConfirm('/control/categories/?delete=yes&category_id=" . $category->getId() . "',
                                        '¬ы действительно хотите удалить раздел?'); return false;\"
                   href='javascript:void(0);'>del</A></TD>

        </TR>
        ";
    }
}