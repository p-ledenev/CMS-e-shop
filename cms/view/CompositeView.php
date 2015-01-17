<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:32
 * To change this template use File | Settings | File Templates.
 */

/* @property View[] $viewList */
abstract class CompositeView extends View
{
    protected $viewList;

    public function __construct($viewList = Array())
    {
        $this->viewList = $viewList;
    }

    public function setViewList($viewList)
    {
        $this->viewList = $viewList;
    }

    public function getViewList()
    {
        return $this->viewList;
    }

    protected function echoBodyTemplate()
    {
        echo $this->printViewList($this->viewList);
    }

    /* @param View[] $viewList */
    protected function printViewList($viewList)
    {
        if (!$viewList)
            return "";

        $response = "";
        foreach ($viewList as $view)
            $response .= $view->view();

        return $response;
    }

}