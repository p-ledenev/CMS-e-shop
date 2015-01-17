<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 17.08.13
 * Time: 13:39
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class CabinetDealProduceListView extends CompositeView
{
    private $deal;

    /* @param Deal $deal */
    public function __construct($deal)
    {
        parent::__construct();
        $this->deal = $deal;

        foreach ($this->deal->getProduceList() as $key => $produce) {
            $this->viewList[] = new CabinetDealProduceView($produce, $key + 1);
        }
    }

    protected function echoHeaderTemplate()
    {
        // styles printed manually for emails
        echo "
        <table class='original_cabinet_table' cellpadding='0' cellspacing='0' border='0' width='700px;'>
                    <TR>
                        <TH width='20px' style='background-color: #f9f9f9;padding: 5px;color: #231F20;font-size:14px;border: 1px solid #d3d3d3;font-weight: 500;'>No.</TH>
                        <TH align='left' style='background-color: #f9f9f9;padding: 5px;color: #231F20;font-size: 14px;border: 1px solid #d3d3d3;font-weight: 500;'>Наименование</TH>
                        <TH width='80px' align=center style='background-color: #f9f9f9;padding: 5px;color: #231F20;font-size: 14px;border: 1px solid #d3d3d3;font-weight: 500;'>Цена</TH>
                        <TH width='80px' align=center style='background-color: #f9f9f9;padding: 5px;color: #231F20;font-size: 14px;border: 1px solid #d3d3d3;font-weight: 500;'>Кол-во</TH>
                        <TH width='80px' align=center style='background-color: #f9f9f9;padding: 5px;color: #231F20;font-size: 14px;border: 1px solid #d3d3d3;font-weight: 500;'>Сумма</TH>
                    </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        $totalTitle = ($this->deal->getDiscontPercent() > 0) ? " (с учетом скидки " . $this->deal->getDiscontPercent() . "%)" : "";

        $response = "";

        // styles printed manually for emails
        $response .= "<TR><TD colspan='4' style='font-weight:500; text-align:right; padding:5px 20px 5px 0; font-size:14px; border: 1px solid #E6E6E6; border-top: 0; color: #4c4c4c;' >
             Итого:$totalTitle</TD><TD style='padding:5px; text-align:center; font-size:14px; border: 1px solid #E6E6E6; border-top: 0; color: #4c4c4c;'>" .
            $this->deal->getAmountWithDiscont() . " руб.</TD></TR></TABLE>";

        echo $response;
    }
}