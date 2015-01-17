<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */

class SubscriptionListTableView extends CompositeView
{
    public function __construct($subscriberList, $url)
    {
        parent::__construct();

        foreach ($subscriberList as $subscriber)
            $this->viewList[] = new SubscriptionTableView($subscriber, $url);

    }

    protected function echoHeaderTemplate()
    {
        echo
        "
    <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH width='100px'>Дата создания</TH>
            <TH width='220px'>Подписчик</TH>
            <TH width='150px'>Подписка</TH>
            <TH>Событие</TH>
            <TH>&nbsp;</TH>
        </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}