<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.04.14
 * Time: 8:39
 */
class ProduceSubscription extends Subscription
{
    /* @return SubscriptionType */
    public function getType()
    {
        return SubscriptionType::$toProduce;
    }

    protected function fillItemPropertyBy($id)
    {
        $this->item = Produce::initEntityWithId("Produce", $id);
    }

    public function sendNotificationTo($email)
    {
        /* @var Produce $produce */
        $produce = $this->getItem();
        $produceUrl = "http://" . $_SERVER['HTTP_HOST'] . $produce->createUrlFor();

        $url = "http://" . $_SERVER['HTTP_HOST'] . "/unsubscribe/" . $this->confirmationCode;
        $body = "<html><body> ������ ����,<BR> ������ �������� ���, ���
            <A href='$produceUrl'>" . $produce->getTitle() . "</A> ����� ���� � ��� � �������.
            <DIV style='padding: 20px 0 0 0; text-size:10px;'>����� ���������� �� �����������, �������� �� ������: <a href='$url'>$url</a></DIV>
            </body></html>";

        mail($email,
            "����������� � ����������� �������� � ������� ������� ��� �������",
            $body,
            "From: market@ayurvedamarket.ru\r\nReply-to: market@ayurvedamarket.ru\r\nContent-type: text/html; charset=\"windows-1251\"\r\n");

    }
}