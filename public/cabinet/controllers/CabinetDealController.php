<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 06.09.13
 * Time: 8:34
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class CabinetDealController extends CabinetController
{
    protected $deal;

    public function __construct(&$request, &$deal)
    {
        parent::__construct($request);

        $this->deal = $deal;
    }

    /* @return View[] */
    protected function getMainViewList()
    {
        $viewList = Array();

        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new CabinetDealDetailView($this->deal);
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0;'>&nbsp;</DIV>");
        $viewList[] = new CabinetDealProduceListView($this->deal);
        $viewList[] = new SimpleTextView("<DIV style='padding:30px 0 0 0;'>&nbsp;</DIV>");
        $viewList[] = new SimpleTextView("</DIV'>");

        return $viewList;
    }
}