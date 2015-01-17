<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 05.09.13
 * Time: 9:45
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class CabinetDealView extends View
{
    protected $deal;

    public function __construct($deal)
    {
        $this->deal = $deal;
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

        $dbg = ($deal->getCustomer()->getDistributon() === true) ? "#F1F1FF" : "";

        $amount = ($deal->getAmount() == $deal->getAmountWithDiscont()) ?
            $deal->getAmount() . " руб." : "<strike>" . $deal->getAmount() . " руб.</strike>
            <br><span class='color_orange'>" . $deal->getAmountWithDiscont() . " руб.</span>";

        $response = "
    <TR style='background-color:$dbg;'
        onMouseOut='this.style.background=\"$dbg\"' onMouseOver='this.style.background=\"#f9f9f9\"'>
        <TD><A class='color_azure' href='/cabinet/" . $deal->getId() . "/'>" . $deal->getOrderNo() . "<BR>"
            . $deal->getStatus()->getParams() . "</A>
        </TD>
        <TD>" . date('d.m.y H:i', $deal->getThedate()) . "</TD>
        <td align='center'> " . $amount . "</TD>
        <TD>" . $deal->getCustomer()->getName() . "</TD>
        <TD>" . $deal->getAddress()->toDetailString() . "</TD>
    </TR>
    ";

        echo $response;
    }
}