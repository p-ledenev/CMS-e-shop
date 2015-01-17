<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

/* @property Subscriber $subscriber */
class SubscriberTableView extends View
{
    private $subscriber;

    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function getSubscriber()
    {
        return $this->subscriber;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $subscriber = $this->subscriber;
        echo "
            <TR onMouseOut='this.style.background=\"\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
            <TD>" . date("d.m.Y h:i:s", $subscriber->getDateCreate()) . "</TD>
            <TD><A href='/control/subscribers/insert.php?id=" . $subscriber->getId() . "'>" . $subscriber->getName() . "</A></TD>
            <TD><A href='/control/subscribers/insert.php?id=" . $subscriber->getId() . "'>" . $subscriber->getEmail() . "</A></TD>
            <TD>
            <A onClick=\"delConfirm('/control/subscribers/?delete=yes&subscriber_id=" . $subscriber->getId() . "', 'Вы действительно хотите удалить подписчика?'); return false;\"
                href='javascript:void(0)'><FONT class='date red'>del</FONT>
            </TD>
            </TR>
        ";
    }
}