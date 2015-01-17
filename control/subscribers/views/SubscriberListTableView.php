<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */


/* @property Subscriber[] $subscriberList */
class SubscriberListTableView extends CompositeView
{
    private $subscriberList;

    /* @param Subscriber[] $subscriberList */
    public function __construct($subscriberList, $url)
    {
        parent::__construct();
        $this->subscriberList = $subscriberList;

        foreach ($subscriberList as $subscriber)
            $this->viewList[] = new SubscriberTableView($subscriber, $url);

    }

    protected function echoHeaderTemplate()
    {
        echo
        "
    <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH width='150px'>Дата создания</TH>
            <TH>Имя</TH>
            <TH>Email</TH>
            <TH>&nbsp;</TH>
        </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}