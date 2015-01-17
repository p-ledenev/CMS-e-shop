<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.01.14
 * Time: 8:44
 */
class MenuView extends CompositeView
{
    protected $styleClass;

    /* @param Category $selectedCategory */
    public static function forTableMenu($categoryList, $selectedCategory)
    {
        $viewList = Array();
        foreach ($categoryList as $category) {
            $isSelected = ($selectedCategory != null && $selectedCategory->equals($category));
            $viewList[] = new MenuItemTableView($category, $isSelected, $categoryList);
        }

        $menuView = new MenuView($viewList, "");

        return $menuView;
    }

    public static function forOneColumnMenu($categoryList)
    {
        $viewList = Array();
        foreach ($categoryList as $category)
            $viewList[] = new MenuItemOneColumnView($category);

        $menuView = new MenuView($viewList, "topmenu");

        return $menuView;
    }

    public function __construct($viewList, $styleClass)
    {
        parent::__construct($viewList);
        $this->styleClass = $styleClass;
    }

    protected function echoHeaderTemplate()
    {
        echo "<TABLE border='0' cellpadding='0' cellspacing='0' class='" . $this->styleClass . "' style='display:block;' align='left'>
        <TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TR></TABLE>";
    }
}