<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 17.08.13
 * Time: 13:44
 * To change this template use File | Settings | File Templates.
 */

/* @property DealProduce $produce */
class DealProduceTableView extends View
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
        if ($this->produce->getAmount() <= 0)
            return;

        $dealProduce = $this->produce;
        $produce = $dealProduce->getProduce();

        $title = $produce->getTitle();
        $strPrice = $dealProduce->getPrice() . " руб.";
        $price = $dealProduce->getPrice();

        if ($dealProduce->getDiscontPercent() > 0) {

            $title = "$title<BR><FONT style='font-style: italic; color:green; font-size:12px;'>
                      со скидкой " . $dealProduce->getDiscontPercent() . "%</FONT>";

            $price = round((1 - 0.01 * $dealProduce->getDiscontPercent()) * $this->produce->getPrice(), 1);

            $strPrice = "<s>$strPrice</S><br><font style='color:green;'>$price руб.</FONT>";
        }

        $bk = ($dealProduce->getInAccomulate() !== true) ? "background:#FFEEEE; font-style:italic" : "";

        $response = "<tr style='$bk;'>
                    <TD style='padding:5px; text-align:left;'>" . $this->key . ".</TD>
                    <TD style='padding:5px; text-align:left;'>$title</TD>
                    <TD style='padding:5px;'>$strPrice</TD>
                    <TD style='padding:5px 10px 5px; 5px; text-align:right'>" . $dealProduce->getAmount() . "&nbsp;&nbsp;
                    <INPUT type='hidden' name='produce_id[]' value='" . $produce->getId() . "'>
                    <INPUT class='input' size='1' name='produce_amount[]'></TD>
                    <TD style='padding:5px;'>" . ($price * $dealProduce->getAmount()) . " руб.</TD>
                    <TD align='center'><A class='date' style='color:#D43424'
                          onClick=\"delConfirm('/control/deals/insert.php?delete=yes&pid=" . $produce->getId() . "&id=" . $dealProduce->getDeal()->getId() . "',
                          'Вы действительно хотите удалить товар из заказа?'); return false;\"
                          href=''>del</A></TD>
                    </TR>";

        echo $response;

    }
}