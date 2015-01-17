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
        $body = "<html><body> Добрый день,<BR> спешим сообщить Вам, что
            <A href='$produceUrl'>" . $produce->getTitle() . "</A> снова есть у нас в наличии.
            <DIV style='padding: 20px 0 0 0; text-size:10px;'>Чтобы отписаться от уведомлений, пройдите по ссылке: <a href='$url'>$url</a></DIV>
            </body></html>";

        mail($email,
            "Уведомление о поступлении продукта в магазин проекта Вся Аюрведа",
            $body,
            "From: market@ayurvedamarket.ru\r\nReply-to: market@ayurvedamarket.ru\r\nContent-type: text/html; charset=\"windows-1251\"\r\n");

    }
}