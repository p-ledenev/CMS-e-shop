<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 05.03.14
 * Time: 8:38
 */
abstract class ProduceListSquareView extends CompositeView
{
    protected $display;
    protected $displayQuantity;
    protected $cartResultId;
    protected $inflowResultId;

    public function __construct($produceList, $partition, $displayQuantity, $display, $cartResultId, $inflowResultId, $showExternalBorders)
    {
        parent::__construct();

        $this->display = $display;
        $this->displayQuantity = $displayQuantity;
        $this->cartResultId = $cartResultId;
        $this->inflowResultId = $inflowResultId;

        if (!$produceList)
            return;

        foreach ($produceList as $index => $produce)
            $this->viewList[] = new ProduceSquareView($produce, $partition, $showExternalBorders, $cartResultId, $inflowResultId, $index, $displayQuantity);
    }

    protected function echoHeaderTemplate()
    {
        $display = ($this->display) ? "" : "none";
        $viewId = $this->getViewId();

        echo "
        <TABLE cellpadding='0' cellspacing='0' border='0' align='center' width='100%' style='display:$display;' id='$viewId'>
        <TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TR></TABLE>";
    }

    public function viewBottomButton()
    {
        $buttonHideId = $this->getViewButtonId();
        $buttonShowId = $this->getShowButtonId();

        $showId = $this->getShowId();
        $hideId = $this->getViewId();

        $text = $this->getButtonText();
        $display = ($this->display == true) ? "" : "none";

        echo "<DIV id='$buttonHideId'
                  style='padding: 10px 20px 0 0; font-size: 14px; text-align: right; display: $display;'>
            <A class='color_azure arial_family' href='javascript:void(0)' style='text-decoration: underline;'
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