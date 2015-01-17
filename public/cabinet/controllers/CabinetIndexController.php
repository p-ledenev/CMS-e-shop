<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 06.09.13
 * Time: 8:35
 * To change this template use File | Settings | File Templates.
 */
class CabinetIndexController extends CabinetController
{
    /* @return View[] */
    protected function getMainViewList()
    {
        $this->getCart()->getDiscontStrategy()->setCustomer($this->getCustomer());

        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new CabinetDealListView($this->getCart(), $this->getCustomer());
        $viewList[] = new SimpleTextView("</DIV>");

        return $viewList;
    }
}