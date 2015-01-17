<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 16.08.13
 * Time: 7:54
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class DealInsertView extends SimpleCompositeView
{
    private $deal;

    public function __construct($deal)
    {
        parent::__construct();

        $this->deal = $deal;
        $this->view = new DealProduceListTableView($deal);
    }

    public function setDeal($deal)
    {
        $this->deal = $deal;
    }

    public function getDeal()
    {
        return $this->deal;
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <form name='order' method='post' action='/control/deals/insert.php' enctype='multipart/form-data'>
    <INPUT type='hidden' name='id' value='" . $this->deal->getId() . "'>
    <TABLE cellspacing='0' cellpadding='0' width='100%' align='center' border='0'>
    <TR>
        <TD style='padding:0 0 20 0;'><FONT class='switch font17 color2'>Покупатель</FONT></TD>
    </TR>

    <TR>
        <TD>";

        include "dealCustomerInfoView.phtml";

        echo "
        </TD>
    </TR>

    <TR>
        <TD>&nbsp;</TD>
    </TR>

    <TR>
        <TD style='padding:0 0 20 0;'><FONT class='switch font17 color2'>Информация о заказе No " . $this->deal->getOrderNo() . "</FONT></TD>
    </TR>
    <TR>
        <TD>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "
        </TD>
        </TR>
        <TR>
            <TD>&nbsp;</TD>
        </TR>

        <TR>
            <TD>";

        include "dealDetailFormView.phtml";

        echo "
            </TD>
        </TR>

        <TR>
            <TD class='yellow_foot line_divs' style='verical-align:center;'>
            <TABLE cellpadding='0' cellsapcing='0' border='0'>
            <TR>
            <TD style='padding: 0 0 0 40px;'>
                <INPUT class='big_button' style='text-align:center' type='submit' name='ofill' value='Сохранить'>
            </TD><TD style='padding: 0 0 0 40px;'>
                <INPUT class='big_button' style='text-align:center' type='submit' name='cfill'
                       value='Сохранить и Закрыть'>
            </TD></TR>
            </TABLE>
            </TD>
        </TR>
        </FORM>
        </TABLE>
        ";
    }
}