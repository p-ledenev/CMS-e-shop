<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 03.03.14
 * Time: 8:42
 */

class ProduceDetailListView extends ProduceListView
{
    public static function createEmptyView()
    {
        return new ProduceDetailListView(null, null, null, null, null);
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
        $view = ProduceShortListView::createEmptyView();

        return $view->getViewButtonId();
    }

    protected function getShowId()
    {
        $view = ProduceShortListView::createEmptyView();

        return $view->getViewId();
    }

    protected function getButtonText()
    {
        return "Скрыть товары";
    }
} 