<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:25
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class DealTableView extends View
{
    private $deal;
    private $url;

    public function __construct($deal, $url)
    {
        $this->deal = $deal;
        $this->url = $url;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $deal = $this->deal;
        $deal->getAddress()->initEntityById();
        $rejectDeals = $deal->getCustomer()->countRejectDeals() > 0 ? " / " . $deal->getCustomer()->countRejectDeals() : "";
        $discontPercent = $deal->getDiscontPercent() > 0 ? "<SPAN style='color:#AA0000'>" . $deal->getDiscontPercent() . "%</SPAN>" : "";

        $dbg = ($deal->getCustomer()->getDistributon() === true) ? "#F1F1FF" : "";
        $separator = (strpos($this->url, "?") !== false) ? "&" : "/?";

        $amount = ($deal->getAmount() == $deal->getAmountWithDiscont()) ?
            $deal->getAmount() . " руб." : "<strike>" . $deal->getAmount() . " руб.</strike>
            <br><span style='color:#AA0000'>" . $deal->getAmountWithDiscont() . " руб.</span>";

        $response = "
    <TR style='background-color:$dbg' onMouseOut='this.style.background=\"$dbg\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
        <TD>" . $deal->getOrderNo() . "<BR><A href='javascript:void(0);'
                                    style='cursor:hand; font-size:11px; text-decoration:none;'
                                    onClick='javascript:list_deal_status(\"" . $deal->getOrderNo() . "\", \"" . $deal->getId() . "\", event); return false;'>" .
            $deal->getStatus()->getParams() . "</A>
        </TD>
        <TD>
            <A href='/control/deals/insert.php?id=" . $deal->getId() . "'>" . date('d.m.y H:i', $deal->getThedate()) . "</A>
        </TD>
        <td align='center'> " . $amount . "</TD>
        <TD><A class='blank'
           href='/control/clients/insert.php?id=" . $deal->getCustomer()->getId() . "'> " . $deal->getCustomer()->getName() . "</A>
        </TD>
        <TD>" . $deal->getCustomer()->countTotalDeals() . $rejectDeals . "</TD>
        <TD align='center'> " . $discontPercent . "</TD>
        <TD><A  class='blank'
           href='/control/clients/modify_address.php?aid=" . $deal->getAddress()->getId() . "'
           onClick='javascript:ShowWin(this.href, 500, 620); return false;'>
            " . $deal->getAddress()->toShortString() . "
            </A>
        </TD>
        <TD> " . $deal->getPaymethod()->getParams() . "</TD>
        <TD>
            <A class='date'
            style='color:#D43424'
            onClick=\"delConfirm('" . $this->url . $separator . "delete=yes&deal_id=" . $deal->getId() . "', 'Выдействительно хотите удалить информацию о заказе?');return false;\"
            href=''>del</A>
        </TD>
    </TR>
    ";

        echo $response;
    }
}