<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 06.09.13
 * Time: 8:49
 * To change this template use File | Settings | File Templates.
 */
abstract class CabinetController extends Controller
{
    /* @return View */
    protected function processOnController()
    {
        if ($this->getCustomer()->getId() <= 0)
            header("Location: http://$_SERVER[HTTP_HOST]/cauth/");

        $viewList = $this->getMainViewList();

        $view = new MainView($this->request);
        $view->setViewList($viewList);

        return $view;
    }

    /* @return View[] */
    protected abstract function getMainViewList();
}