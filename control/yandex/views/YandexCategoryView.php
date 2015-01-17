<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 15.08.14
 * Time: 8:24
 */

/* @property YandexCategory $category */
abstract class YandexCategoryView extends View
{
    protected $category;
    protected $depth;

    public function __construct($category, $depth)
    {
        $this->category = $category;
        $this->depth = $depth;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getDepth()
    {
        return $this->depth;
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

    public function countLeftPadding()
    {
        return ($this->depth * 20) . "px";
    }
}