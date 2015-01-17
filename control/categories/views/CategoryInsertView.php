<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 7:58
 * To change this template use File | Settings | File Templates.
 */

/* @property Category $category */
class CategoryInsertView extends View
{
    protected $category;

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
        include "categoryInsertView.phtml";
    }
}