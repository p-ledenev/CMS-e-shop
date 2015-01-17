<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 12:21
 * To change this template use File | Settings | File Templates.
 */

/* @property Cart $cart */
class ShowCartProduceListView extends CompositeView
{
    protected $cart;

    /* @param Cart $cart */
    public function __construct($cart)
    {
        $this->cart = $cart;

        foreach ($this->cart->getProduceList() as $key => $produce) {
            $this->viewList[] = new ShowCartProduceView($produce, $key + 1, "");
        }
    }

    protected function echoHeaderTemplate()
    {
        echo "
                        <TABLE cellpadding='0' cellspacing='0' border='0'
                               style='border-collapse:collapse; vertical-align:top;' width='100%'>
                            <TR>
                                <TD class='color_gray bordercolor_lightgray arial_family' style='border-bottom-width: 1px; font-size: 12px; text-align: left; padding: 0 0 10px 20px;'>
                                    Наименование
                                </TD>
                                <!--
                                <TD class='color_gray bordercolor_lightgray' style='border-bottom-width: 1px; font-size: 12px; text-align: center; padding: 0 0 10px 0px;'>
                                    Скидка
                                </TD>
                                -->
                                <TD class='color_gray bordercolor_lightgray arial_family' style='border-bottom-width: 1px; font-size: 12px; text-align: center; padding: 0 0 10px 0px;'>
                                    <NOBR>Стоимость / Руб.</NOBR>
                                </TD>
                                <TD class='color_gray bordercolor_lightgray arial_family' style='border-bottom-width: 1px; font-size: 12px; text-align: center; padding: 0 0 10px 0px;'>
                                    Количество
                                </TD>
                                <TD class='color_gray bordercolor_lightgray arial_family' style='border-bottom-width: 1px; font-size: 12px; text-align: center; padding: 0 0 10px 0px;'>
                                    <NOBR>Сумма / Руб.</NOBR>
                                </TD>
                            </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        $positionCount = $this->cart->countProduceAmount();
        $purchase = $this->cart->countProducePurchase();

        //echo "<A href='javascript:void(0);' onClick='ShowWin(\"/cartclear/\", 300, 350)' style='color:#B43200;'><i>Очистить корзину</i></A>";

        echo "
    <TABLE cellpadding='0' cellspacing='0' border='0'>
    <TR><TD style='padding:40px 0 0 0;'></TD></TR>
    <TR>
        <TD width='175px' style='font-size: 12px; text-align: center; border-width:1px; padding:0 20px 0 20px;' class='color_gray bordercolor_lightgray arial_family'>
        Вы можете оформить<BR> свой заказ и по телефону:<BR>
        <SPAN class='color_warmgray' style='font-size: 18px;'>+7 495 745 1078</SPAN></TD>

        <TD width='175px' class='backcolor_lime color_brown arial_family' style='font-size: 12px; text-align: center; padding: 20px 20px 20px 20px;'>
        Итого $positionCount товаров на сумму<BR>
        <SPAN style='font-size: 20px;'>$purchase</SPAN><BR>
        рублей
        </TD>

        <TD width='175px' style='font-size: 24px; text-align: center;' class='backcolor_gray color_white'>
        <A href='javascript:void(0);' class='color_white' onClick='document.location=\"/auth/\"'
        style='text-decoration:none;'>
        Оформить<BR>заказ</A></TD>

        <TD width='175px' class='backcolor_lime color_brown' style='font-size: 24px; text-align: center; padding: 20px 0 20px 0;'>
        <A href='javascript:void(0);' class='color_white' onClick='document.forms[\"cart_form\"].submit(); return false;'
        style='text-decoration:none;'>
        Пересчитать</A>
        </TD>
    </TR>
    </TABLE>";
    }
}