<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 8:01
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce
 * @property Cart $cart
 */
class PopupCartAddView extends View
{
    protected $produce;
    protected $cart;

    public function __construct($produce, $cart)
    {
        $this->produce = $produce;
        $this->cart = $cart;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $title = $this->produce->getTitle();
        $vendor = $this->produce->getVendor();
        $vendorLocation = $this->produce->getVendorLocation();

        echo "
        <DIV width='100%' align='center' style='text-align:center' border='0'>
         <IMG border='0' src='/images/produce_added.png'>
        </DIV>
        <SCRIPT>
           setTimeout(\"window.close()\", 1000);
        </SCRIPT>";
    }
}

/*
         <TABLE width='100%' align='center' style='text-align:center' cellpadding='10' cellspacing='10'>
            <TR>
                <TD style='font-weight:500;'>Добавлено в корзину:</TD>
            </TR>
            <TR>
                <TD style='font-size:18px' class='color_marsh'>$title</TD>
            </TR>
            <TR>
                <TD style='font-style:italic; font-size: 16px;' class='color_gray'>($vendor - $vendorLocation)</TD>
            </TR>
 */