<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */


/* @property Deal[] $dealList */
class DealListTableView extends CompositeView
{
    private $dealList;

    public function __construct($dealList, $url)
    {
        parent::__construct();
        $this->dealList = $dealList;

        foreach ($dealList as $deal)
            $this->viewList[] = new DealTableView($deal, $url);
    }

    protected function echoHeaderTemplate()
    {
        echo
        "
<table class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
<TR>
    <TH width='70px'>No \ ������</TH>
    <TH width='80px'>����</TH>
    <TH width='90px'>���������</TH>
    <TH width='160px'>��� ���������</TH>
    <TH>����������<BR>�������</TH>
    <TH>������<BR>�������</TH>
    <TH>�����</TH>
    <TH>������ ������</TH>
    <TH>&nbsp;</TH>
</TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        $total = $amount = $amountWithDiscont = 0;
        foreach ($this->dealList as $deal) {
            if (!$deal->getStatus()->equals(DealStatus::$reject)) {
                $total++;
                $amount += $deal->getAmount();
                $amountWithDiscont += $deal->getAmountWithDiscont();
            }
        }

        echo "
<TR>
    <TD colspan='2' class='txt' style='text-align:right; padding:3px 10px 3px 0px; font-size:13px;'>
        ����� ��� ������:
    </TD>
    <TD colspan='2' style='text-align:left; padding:0px 0px 0px 10px; color:#1668A7;'>$amount ���.</TD>
    <TD colspan='4'></TD>
</TR>
<TR>
    <TD colspan='2' class='txt' style='text-align:right; padding:3px 10px 3px 0px; font-size:13px;'>����� �� �������:</TD>
    <TD colspan='2' style='text-align:left; padding:0px 0px 0px 10px; color:#1668A7;'>$amountWithDiscont ���.</TD>
    <TD colspan='4'></TD>
</TR>
<TR>
    <TD colspan='2' class='txt' style='text-align:right; padding:3px 10px 3px 0px; font-size:13px;'>
        ����� �������:
    </TD>
    <TD colspan='2' style='text-align:left; padding:0px 0px 0px 10px; color:#1668A7;'>$total ��.</TD>
    <TD colspan='4'></TD>
</TR>
</table>";
    }
}