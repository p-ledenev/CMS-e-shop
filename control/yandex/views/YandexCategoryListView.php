<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 15.08.14
 * Time: 8:23
 */
class YandexCategoryListView extends CompositeView
{
    public function __construct($categoryList, $depth = 0)
    {
        /* @var YandexCategory $category */
        foreach ($categoryList as $category) {
            $this->viewList[] = $category->hasChild() ? new YandexCategoryParentView($category, $depth) : new YandexCategoryLeafView($category, $depth);

            if ($category->hasChild())
                $this->viewList[] = new YandexCategoryListView($category->getChildList(), $depth + 1);
        }
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }
}