<?php

/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 17.08.13
 * Time: 13:13
 * To change this template use File | Settings | File Templates.
 */
class DealStatusSelectorView extends View
{
    private $url;

    public function __construct($url)
    {
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
        $response = "
        <DIV id='statusDIV' ALIGN='left'
             style='display:none; shadow:1; top: 124px; left: 30px; position: absolute; z-index:3;'>
            <TABLE width='200px' onMouseOver=\"statusDIV.style.display = 'inline'\" onMouseOut=\"statusDIV.style.display = 'none'\"
                   border='0' cellpadding='5' cellspacing='5'
                   style='border:1px solid grey; border-collapse: collapse; filter: Shadow()' bordercolor=gray
                   bgcolor=white
                   id='AutoNumber1' height='34'>
                <TR>
                    <TD class='date' style='padding:10px 0px 0 20px;'>
                    Статус заказа No.<SPAN id='orderNo' name='orderNo'>sd</SPAN>
                    <SPAN id='orderId' name='orderId' style='display:none;'>sd</SPAN>
                    </TD>
                </TR>
         ";

        /* @var DealStatus $item */
        foreach (DealStatus::getAllItems("DealStatus") as $item)
            $response .= "
                <TR>
                    <TD style='padding:5px 0px 0 20px;'>
                    <A href='javascript:change_deal_status(" . $item->getCode() . ", \"" . $this->url . "\")'>" . $item->getParams() .
                "</A></TD>
                </TR>
                ";

        $response .= "<TD>&nbsp</TD></TABLE></DIV>";

        echo $response;
    }
}

;