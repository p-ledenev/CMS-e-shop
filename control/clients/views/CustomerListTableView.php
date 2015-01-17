<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 19.08.13
 * Time: 23:53
 * To change this template use File | Settings | File Templates.
 */

class CustomerListTableView extends CompositeView
{
    public function __construct($customerList)
    {
        parent::__construct();

        foreach ($customerList as $customer)
            $this->viewList[] = new CustomerTableView($customer);
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH>ФИО</TH>
            <TH>Email</TH>
            <TH>Телефон</TH>
            <TH>Кол-во покупок / аннул.</TH>
            <TH>Сумма заказов</TH>
            <TH>&nbsp;</TH>
        </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}