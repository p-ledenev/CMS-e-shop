<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 03.09.13
 * Time: 7:49
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class SelectAddressListView extends CompositeView
{
    protected $customer;

    /* @param Customer $customer */
    public function __construct($customer, $giftForm)
    {
        parent::__construct();

        $this->customer = $customer;

        foreach ($customer->getAddressList() as $address)
            $this->viewList[] = new SelectAddressView($address, $giftForm);
    }

    protected function echoHeaderTemplate()
    {
        if (count($this->customer->getAddressList()) > 0)
            echo "<TR><TD class='backcolor_lightgray' style='padding:20px 0 10px 0;'>
            <TABLE width='100%' cellpadding='0' cellapscing='0' border='0'>
                    <TR>
                        <TD width='100%' align='left' style='padding: 0 0 10px 20px; font-size:16px;' class='color_marsh arial_family'>
                            Подтвердите, пожалуйста, если адрес доставки остался прежним
                        </TD>
                    </TR>
                    <TR><TD style='padding: 0px 0 0 0; font-size: 8px;'>&nbsp;</TD></TR>
            ";
    }

    protected function  echoFooterTemplate()
    {
        if (count($this->customer->getAddressList()) > 0)
            echo "</TABLE></TD></TR>";
    }
}