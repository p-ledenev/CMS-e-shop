<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 13.08.13
 * Time: 13:43
 * To change this template use File | Settings | File Templates.
 */

/* @property View $view */
abstract class SimpleCompositeView extends View
{
    protected $view;

    public function __construct($view = null)
    {
        $this->view = $view;
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function getView()
    {
        return $this->view;
    }

    protected function echoBodyTemplate()
    {
        echo $this->view->view();
    }
}