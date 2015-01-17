<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 17.08.13
 * Time: 13:39
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class DealProduceListTableView extends CompositeView
{
    private $deal;

    /* @param Deal $deal */
    public function __construct($deal)
    {
        parent::__construct();
        $this->deal = $deal;

        foreach ($this->deal->getProduceList() as $key => $produce) {
            $this->viewList[] = new DealProduceTableView($produce, $key + 1);
        }
    }

    protected function echoHeaderTemplate()
    {
        echo "
            <DIV style='padding:0 0 10px 0;'>
            <TABLE width='700px'><TR>
            <TD width='50%' style='color:#555;'>Собрано:  _____________________________</TD>
            <TD width='50%' style='color:#555;'>Проверено:  _____________________________</TD>
            </TR></TABLE>
            </DIV>
        ";

        echo "
        <table class='original_table' cellpadding='0' cellspacing='0' border='0' width='70%'>
                    <TR>
                        <TH>No.</TH>
                        <TH align='left'>Наименование</TH>
                        <TH align=center>Цена</TH>
                        <TH align=center>Кол-во</TH>
                        <TH align=center>Сумма</TH>
                        <TH>&nbsp;</TH>
                    </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        $response = "
        <INPUT type='hidden' name='add_produce'>
            <TR>
            <TD style='padding:5px; text-align:left;'>" . (count($this->deal->getProduceList()) + 1) . ".</TD>
            <TD align='left' style='text-align:left;'>
            <INPUT class='input' name='add_produce_name' size=50>
                <INPUT type='button' value='...'
               onClick='javascript:ShowWin(\"/control/produces/select.php?form=order&field=add_produce\", 800, 700)'>
            </TD>
            </TD>
            <TD>&nbsp;</TD>
            <TD style='text-align:right; padding:0 10px 0 0;'><INPUT class='input' size='1' name='add_produce_amount'></TD>
            <TD>&nbsp;</TD>
            <TD>&nbsp;</TD>
            </TR>
        ";

        $totalTitle = ($this->deal->getDiscontPercent() > 0) ? " (с учетом скидок)" : "";

        $response .= "<TR ><TD colspan='4' style = 'font-weight:500; text-align:right; padding:5px 20px 5px 0;' >
             Итого:$totalTitle</TD><TD style='padding:5px; text-align:center;'>" .
            $this->deal->getAmountWithDiscont() . " руб.</TD><TD></TD></TR></TABLE>";

        echo $response;
    }
}