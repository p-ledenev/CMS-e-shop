<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 9:16
 * To change this template use File | Settings | File Templates.
 */

class IndexController extends Controller
{
    public function __construct(&$cart)
    {
        parent::__construct($cart);
    }

    /* @return View */
    protected function processOnController()
    {
        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        //$viewList[] = ViewFactory::createHeadCarousel();
        $viewList[] = new IndexView();
        $viewList[] = new SimpleTextView("</DIV>");

        $view = new MainView($this->request);
        $view->setViewList($viewList);

        return $view;
    }
}

;