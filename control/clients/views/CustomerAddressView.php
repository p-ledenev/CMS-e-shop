<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 20.08.13
 * Time: 8:39
 * To change this template use File | Settings | File Templates.
 */

/* @property Address $address */
class CustomerAddressView extends View
{
    private $address;

    public function __construct($address)
    {
        $this->address = $address;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $this->address->initEntityById();

        echo "
<TR>
    <TD><A target='_blank' class='blank'
           href='/control/addresses/update.php?aid=" . $this->address->getId() . "'
           onClick='javascript:ShowWin(this.href, 500, 620); return false;'>
            " . $this->address->toDetailString() . "</A>
    </TD>
    <TD>
        <A class='date' style='color:#D43424;'
           onClick=\"delConfirm('/control/clients/insert.php?delete=yes&id=" . $this->address->getCustomer()->getId() . "&aid=" . $this->address->getId() . "',
               'Вы действительно хотите удалить адерс клиента?'); return false;\"
           title='Удалить адрес клиента' alt='Удалить адрес клиента'
           href=''>del</A>
    </TD>
    <TD>
        <A class='date' style='color:#006400;'
           href='/control/clients/insert_deal.php?address=" . $this->address->getId() . "&customer=" . $this->address->getCustomer()->getId() . "'
           title='Добавить заказ по адресу' alt='Добавить заказ по адресу'>add</A>
    </TD>
</TR>
";
    }
}