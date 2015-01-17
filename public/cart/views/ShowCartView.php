<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 17:45
 * To change this template use File | Settings | File Templates.
 */

/* @property Cart $cart */
class ShowCartView extends SimpleCompositeView
{
    protected $cart;

    /* @param Cart $cart */
    public function __construct($cart)
    {
        parent::__construct();

        $this->cart = $cart;

        if ($this->cart->countProduceAmount() > 0)
            $this->view = new ShowCartProduceListView($cart);
        else
            $this->view = new ShowEmptyCartView();
    }

    protected function echoHeaderTemplate()
    {
        include "showCartViewHeader.phtml";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TD></TR></TABLE>
              <TR><TD style='padding:10px 0 0 0;'>&nbsp;</TD></TR>
              </FORM>
              </TD></TR></TABLE>
        ";
    }
}