<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 19.08.13
 * Time: 23:59
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer */
class CustomerTableView extends View
{
    private $customer;

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
        $customer = $this->customer;
        $customer->getDealList();

        $distribution = (strlen($customer->getDistributon()) > 0) ?
            "номер дистрибьютера: " . $customer->getDistributon() : "";
        $dbg = (strlen($customer->getDeposit()) > 0) ? "#F1F1FF" : "";

        echo "
<TR style='background-color:$dbg' onMouseOut='this.style.background=\"$dbg\"'
    onMouseOver='this.style.background=\"#FFEEEE\"'>
    <TD style='text-align:left;'><A
            href=\"/control/clients/insert.php?id=" . $customer->getId() . "\">" . $customer->getName() . "</A>&nbsp;" .
            $distribution . "
    </TD>
    <TD style='text-align:left;'>" . $customer->getEmail() . "</TD>
    <TD>" . $customer->getPhone() . "</TD>
    <TD>" . $customer->countTotalDeals() . (($customer->countRejectDeals() > 0) ? " / " . $customer->countRejectDeals() : "") . "</TD>
    <TD>" . $customer->calculateDealListPurchaseWithDiscont() . " руб.</TD>
    <TD>
        <A class='date' style='color:#D43424'
           onClick=\"delConfirm('/control/clients/?delete=yes&id=" . $customer->getId() . "',
        'Вы действительно хотите удалить информацию о клиенте?'); return false;\"
        href=\"\">del</A></TD>

</TR>
";
    }
}