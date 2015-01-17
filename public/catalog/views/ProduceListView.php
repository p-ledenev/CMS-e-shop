<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 05.03.14
 * Time: 8:38
 */

/* @property Produce[] $produceList
 * @property Partition $partition
 */
abstract class ProduceListView extends View
{
    protected $produceList;
    protected $partition;
    protected $count;
    protected $display;
    protected $cartResultId;
    protected $inflowResultId;
    protected $showExternalBorders;

    public function __construct($produceList, $partition, $count, $display, $cartResultId, $inflowResultId, $showExternalBorders)
    {
        parent::__construct();

        $this->produceList = $produceList;
        $this->count = $count;
        $this->display = $display;
        $this->partition = $partition;
        $this->cartResultId = $cartResultId;
        $this->inflowResultId = $inflowResultId;
        $this->showExternalBorders = $showExternalBorders;
    }

    public function setShowExternalBorders($showExternalBorders)
    {
        $this->showExternalBorders = $showExternalBorders;
    }

    public function getShowExternalBorders()
    {
        return $this->showExternalBorders;
    }

    public function setInflowResultId($inflowResultId)
    {
        $this->inflowResultId = $inflowResultId;
    }

    public function getInflowResultId()
    {
        return $this->inflowResultId;
    }

    public function setCartResultId($resultId)
    {
        $this->cartResultId = $resultId;
    }

    public function getCartResultId()
    {
        return $this->cartResultId;
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    public function getPartition()
    {
        return $this->partition;
    }

    public function setProduceList($produceList)
    {
        $this->produceList = $produceList;
    }

    public function setDisplay($display)
    {
        $this->display = $display;
    }

    public function getDisplay()
    {
        return $this->display;
    }

    public function getProduceList()
    {
        return $this->produceList;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "produceListView.phtml";
    }

    public function viewBottomButton()
    {
        $buttonHideId = $this->getViewButtonId();
        $buttonShowId = $this->getShowButtonId();

        $showId = $this->getShowId();
        $hideId = $this->getViewId();

        $text = $this->getButtonText();
        $display = ($this->getDisplay() == true) ? "" : "none";

        echo "<DIV id='$buttonHideId'
                  style='padding: 10px 20px 0 0; font-size: 14px; text-align: right; display: $display;'>
            <A class='color_azure' href='javascript:void(0)' style='text-decoration: underline;'
            onClick='showElementBy(\"$showId\"); hideElementBy(\"$hideId\"); showElementBy(\"$buttonShowId\"); hideElementBy(\"$buttonHideId\"); return false;'>
            $text
        </A></DIV>";
    }

    public abstract function getViewId();

    public abstract function getViewButtonId();

    protected abstract function getShowButtonId();

    protected abstract function getShowId();

    protected abstract function getButtonText();
}