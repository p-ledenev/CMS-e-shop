<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 03.09.13
 * Time: 7:28
 * To change this template use File | Settings | File Templates.
 */
class OrderGiftStrategiesView extends CompositeView
{

    /* @param Cart $cart */
    public function __construct($cart, $deal)
    {
        parent::__construct();

        foreach ($cart->getGiftStrategyList() as $strategy)
            $this->viewList[] = new SelectDealGiftListView($strategy, $deal);
    }

    protected function echoHeaderTemplate()
    {
        echo "<TR><TD>";
    }

    protected function  echoFooterTemplate()
    {
        echo "
        </TD></TR>

        <TR>
            <TD>&nbsp;&nbsp;</TD>
        </TR>
        ";
    }
}