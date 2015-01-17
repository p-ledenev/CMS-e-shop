<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 04.09.13
 * Time: 19:20
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class OrderGiftListView extends CompositeView
{
    protected $deal;

    /* @param Deal $deal */
    public function __construct($deal)
    {
        parent::__construct();
        $this->deal = $deal;

        foreach ($deal->getGiftList() as $produce)
            $this->viewList[] = new OrderGiftView($produce);
    }

    protected function echoHeaderTemplate()
    {
        if (!$this->deal->isEmptyGiftList())
            echo "
            <TABLE border='0' cellpadding='0' cellspacing='0' align='center' width='700px'>
                <TR>
                    <TD valign='top' style='padding: 20px 30px 20px 10px;'>
                        <DIV style='padding:0 0 0 0; font-size: 16px' class='color_marsh arial_family'>
                        Ваш подарок
                        </DIV>
                     </TD>
                </TR>
            ";
    }

    protected function  echoFooterTemplate()
    {
        if (!$this->deal->isEmptyGiftList())
            echo "</TABLE>";
    }
}