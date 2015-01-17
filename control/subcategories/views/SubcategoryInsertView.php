<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 7:58
 * To change this template use File | Settings | File Templates.
 */

/* @property Subcategory $subcategory */
class SubcategoryInsertView extends View
{
    protected $subcategory;

    public function __construct($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function setSubcategory($category)
    {
        $this->subcategory = $category;
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
        include "subcategoryInsertView.phtml";
    }
}