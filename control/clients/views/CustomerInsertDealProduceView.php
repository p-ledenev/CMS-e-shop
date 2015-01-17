<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 22.08.13
 * Time: 9:59
 * To change this template use File | Settings | File Templates.
 */

/* @property DealProduce $produce */
class CustomerInsertDealProduceView extends View
{
    private $produce;
    private $key;

    public function __construct($produce, $key)
    {
        $this->produce = $produce;
        $this->key = $key;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $produce = $this->produce->getProduce();

        echo "
        <tr>
    <TD style='padding:5px; text-align:left;'>" . ($this->key + 1) . ".</TD>
    <TD align='left' style='text-align:left;'>
        <INPUT class='input' name='deal_produce_name[" . $this->key . "]' size=60 value='" . $produce->getTitle() . "'>
        <INPUT type='hidden' name='deal_produce[" . $this->key . "]' value='" . $produce->getId() . "'>
        <INPUT type='button' value=' ...'
               onClick='javascript:ShowWin(\"/control/produces/select.php?form=order&field=deal_produce[" . $this->key . "]&field_name=deal_produce_name[" . $this->key . "]\",
               800, 700)'>
    </TD>
    <TD>&nbsp;&nbsp;&nbsp;<INPUT class='input' size='1' name='deal_amount[" . $this->key . "]' value='" . $this->produce->getAmount() . "'></TD>
    </TR>
        ";
    }
}

;