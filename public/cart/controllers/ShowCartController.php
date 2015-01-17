<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 17:43
 * To change this template use File | Settings | File Templates.
 */

class ShowCartController extends Controller
{
    protected $cdata;

    public function __construct(&$request, $cdata)
    {
        parent::__construct($request);

        $this->cdata = $cdata;
    }

    /* @return View */
    protected function processOnController()
    {
        if ($this->cdata['rec']) {
            $this->getCart()->clear();

            foreach ($this->cdata['amount'] as $key => $amount) {
                $produce = Produce::initEntityWithId("Produce", $this->cdata['produce'][$key]);

                if ($amount > 0)
                    $this->getCart()->addItemBy($produce, $amount);
            }
        }

        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new ShowCartView($this->getCart());
        $viewList[] = new SimpleTextView("</DIV>");

        $view = new MainView($this->request);
        $view->setViewList($viewList);

        return $view;
    }
}