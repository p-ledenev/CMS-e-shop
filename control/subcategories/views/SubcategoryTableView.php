<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

/* @property Subcategory $subcategory */
class SubcategoryTableView extends View
{
    private $subcategory;

    public function __construct($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function getSubcategory()
    {
        return $this->subcategory;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $subcategory = $this->subcategory;
        echo "
            <TR onMouseOut='this.style.background=\"\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
            <TD>" . $subcategory->getSort() . "</TD>
            <TD><A href='/control/subcategories/insert.php?id=" . $subcategory->getId() . "'>" . $subcategory->getName() . "</A></TD>
            <TD><A target='_blank' href='/" . $subcategory->getUrl() . "/'>" . $subcategory->getUrl() . "</A></TD>
            <TD>
                <A class='date'style='color:#D43424' onClick=\"delConfirm('/control/subcategories/?delete=yes&subcategory_id=" . $subcategory->getId() . "',
                                        '¬ы действительно хотите удалить раздел?'); return false;\"
                   href='javascript:void(0);'>del</A></TD>

        </TR>
        ";
    }
}