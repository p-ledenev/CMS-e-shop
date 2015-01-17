<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 20.08.13
 * Time: 8:39
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class CustomerAddressListView extends CompositeView
{
    private $customer;

    /* @param Customer $customer */
    public function __construct($customer)
    {
        parent::__construct();
        $this->customer = $customer;

        foreach ($this->customer->getAddressList() as $address)
            $this->viewList[] = new CustomerAddressView($address);
    }

    protected function echoHeaderTemplate()
    {
        $customerId = $this->customer->getId();

        echo "
        <TABLE cellspacing='0' cellpadding='0' width='100%' align='center' border='0' style='padding: 20px 0 0 0;'>

        <TR>
            <TD style='padding:0 0 5px 0;'><FONT class='switch font17 color2'>Адреса клиента</FONT></TD>
        </TR>

        <TR>
            <TD style='padding:0 0 10px 0;'><A target='_blank' class='blank'
                                               href='/control/addresses/insert.php?cid=$customerId'
                                               onClick='javascript:ShowWin(this.href, 500, 620); return false;'>
                    Добавить новый адрес</A></TD>
        </TR>
        <TR>
            <TD style='padding:0 0 10px 0;'>
                <TABLE cellpadding='10' cellspacing='10' border='0'>
                    <TR>
                        <TD><A target='_blank' class='blank'
                               href='/control/addresses/update.php?aid=5158'
                               onClick='javascript:ShowWin(this.href, 500, 620); return false;'>
                                Самовывоз</A>
                        </TD>
                        <TD>
                        </TD>
                        <TD>
                            <A class='date' style='color:#006400;'
                               href='/control/clients/insert_deal.php?address=5158&customer=$customerId'
                               title='Добавить заказ по адресу' alt='Добавить заказ по адресу'>add</A>
                        </TD>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "
            </TABLE>
            </TD>
        </TR>
        </TABLE>
        ";
    }
}