<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 28.02.14
 * Time: 9:28
 */
class ProduceShortListSquareView extends ProduceListSquareView
{
    public static function createEmptyView()
    {
        return new ProduceShortListSquareView(null, null, null, null);
    }

    public function __construct($produceList, $partition, $cartResultId, $inflowResultId, $showExternalBorders = true, $count = 9)
    {
        parent::__construct($produceList, $partition, $count, true, $cartResultId, $inflowResultId, $showExternalBorders);
    }

    public function getViewId()
    {
        return "shortProduceListView";
    }

    public function getViewButtonId()
    {
        return "showAllButton";
    }

    protected function getShowButtonId()
    {
        $view = ProduceDetailListSquareView::createEmptyView();

        return $view->getViewButtonId();
    }

    protected function getShowId()
    {
        $view = ProduceDetailListSquareView::createEmptyView();

        return $view->getViewId();
    }

    protected function getButtonText()
    {
        return "Показать еще товары";
    }

    public function viewBottomButton()
    {
        if (count($this->viewList) <= $this->displayQuantity)
            return;

        parent::viewBottomButton();
    }
}