<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 17.08.13
 * Time: 13:44
 * To change this template use File | Settings | File Templates.
 */

/* @property DealProduce $produce */
class CabinetDealProduceView extends View
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

            $title = "$title<BR><FONT style='font-style:italic; font-size:12px;' style='color: #F7941E;'>
                      со скидкой " . $dealProduce->getDiscontPercent() . "%</FONT>";

            $price = round((1 - 0.01 * $dealProduce->getDiscontPercent()) * $produce->getPrice());

            $strPrice = "<s>$strPrice</S><br><font style='color: #F7941E;'>$price руб.</FONT>";
        }

        $bk = ($dealProduce->getInAccomulate() !== true) ? "background:#FFEEEE; font-style:italic" : "";

        $response = "<tr style='$bk;'>
                    <TD style='padding:5px; text-align:left; font-size:14px; color:#4c4c4c; border:1px solid #E6E6E6; border-top: 0;'>" . $this->key . ".</TD>
                    <TD style='padding:5px; text-align:left; font-size:14px; color:#4c4c4c; border:1px solid #E6E6E6; border-top: 0;'>$title</TD>
                    <TD style='padding:5px; font-size:14px; color:#4c4c4c; border:1px solid #E6E6E6; border-top: 0; text-align: center;'>$strPrice</TD>
                    <TD style='padding:5px; font-size:14px; color:#4c4c4c; border:1px solid #E6E6E6; border-top: 0; text-align: center;'>" . $dealProduce->getAmount() . "</TD>
                    <TD style='padding:5px; font-size:14px; color:#4c4c4c; border:1px solid #E6E6E6; border-top: 0; text-align: center;'>" . ($price * $dealProduce->getAmount()) . " руб.</TD>
                    </TR>";

        echo $response;

    }
}