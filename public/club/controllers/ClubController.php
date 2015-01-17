<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 14.07.14
 * Time: 12:17
 */
class ClubController extends SubscribeFormController
{
    /* @return View */
    protected function processOnController()
    {
        $viewList = Array();
        $viewList[] = new ClubIndexView($this->getRealSubscriber(), Constants::$clubResultId, Constants::$mainBodyId);

        $headViewList = Array();
        $headViewList[] = new AJAXResultView(Constants::$clubResultId);

        $view = new MainView($this->request);

        $view->setViewList($viewList);
        $view->setHeadViewList($headViewList);

        return $view;
    }
}