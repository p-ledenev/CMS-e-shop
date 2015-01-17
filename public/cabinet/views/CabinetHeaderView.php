<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 06.09.13
 * Time: 9:01
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class CabinetHeaderView extends View
{
    protected $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo "
         <TABLE width='100%' cellpadding='0' cellapscing='0' border='0'>
            <TR>
                <TD style='padding:5px; font-size:16px;' class='arial_family'>
                    Добрый день, " . $this->customer->getName() . "!
                </TD>
            </TR>
        </TABLE>
       ";
    }
}