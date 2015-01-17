<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.01.14
 * Time: 8:39
 */

/* @property Category $category
 * @property Category[] $categoryList
 */

class MenuItemTableView extends View
{
    protected $category;
    protected $isSelected;
    protected $categoryList;

    public function setCategoryList($categoryList)
    {
        $this->categoryList = $categoryList;
    }

    public function getCategoryList()
    {
        return $this->categoryList;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setIsSelected($isSelected)
    {
        $this->isSelected = $isSelected;
    }

    public function getIsSelected()
    {
        return $this->isSelected;
    }

    public function __construct($category, $isSelected, $categoryList)
    {
        $this->category = $category;
        $this->isSelected = $isSelected;
        $this->categoryList = $categoryList;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "menuItemTableView.phtml";
    }
}