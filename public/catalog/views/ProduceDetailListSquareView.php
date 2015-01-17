<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 03.03.14
 * Time: 8:42
 */

class ProduceDetailListSquareView extends ProduceListSquareView
{
    public static function createEmptyView()
    {
        return new ProduceDetailListSquareView(null, null, null, null, null);
    }

    public function __construct($produceList, $partition, $cartResultId, $inflowResultId, $display, $showExternalBorders = true)
    {
        parent::__construct($produceList, $partition, count($produceList), $display, $cartResultId, $inflowResultId, $showExternalBorders);
    }

    public function getViewId()
    {
        return "detailProduceListView";
    }

    public function getViewButtonId()
    {
        return "hideAllButton";
    }

    protected function getShowButtonId()
    {
        $view = ProduceShortListSquareView::createEmptyView();

        return $view->getViewButtonId();
    }

    protected function getShowId()
    {
        $view = ProduceShortListSquareView::createEmptyView();

        return $view->getViewId();
    }

    protected function getButtonText()
    {
        return "Скрыть товары";
    }
} 