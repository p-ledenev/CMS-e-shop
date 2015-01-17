<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 18:15
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class OrderMakeController extends Controller
{
    protected $deal;

    /* @param Deal $deal */
    public function __construct(&$request, &$deal)
    {
        parent::__construct($request);

        $this->deal = $deal;
    }

    /* @return View */
    protected function processOnController()
    {
        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new OrderMakeView($this->deal);
        $viewList[] = new SimpleTextView("</DIV'>");

        $view = new MainView($this->request);
        $view->setViewList($viewList);

        return $view;
    }
}