<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 28.02.14
 * Time: 9:28
 */

/* @property Produce[] $produceList
 * @property Partition $partition
 */
class ProduceShortListView extends ProduceListView
{
    public static function createEmptyView()
    {
        return new ProduceShortListView(null, null, null, null);
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
        $view = ProduceDetailListView::createEmptyView();

        return $view->getViewButtonId();
    }

    protected function getShowId()
    {
        $view = ProduceDetailListView::createEmptyView();

        return $view->getViewId();
    }

    protected function getButtonText()
    {
        return "Показать еще товары";
    }

    public function viewBottomButton()
    {
        if (count($this->produceList) <= $this->count)
            return;

        parent::viewBottomButton();
    }
}