<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 09.07.14
 * Time: 17:58
 */

/* @property Deal $deal
 * @property Customer $administrator
 */
class DealMailPostView extends View
{
    protected $deal;
    protected $administrator;

    public function __construct($deal, $administrator)
    {
        $this->deal = $deal;
        $this->administrator = $administrator;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $customer = $this->deal->getCustomer();
        $name = (strlen($customer->getPostFirstName()) > 0) ? $customer->getPostFirstName() . " " . $customer->getPostMiddleName() : $customer->getName();

        $postDate = date("d.m.Y", $this->deal->getPostDate());
        $postId = $this->deal->getPostId();

        $adminName = $this->administrator->getName();

        if (Paymethod::$post->equals($this->deal->getPaymethod()))
            $amount = "Сумма наложенного платежа составила " . $this->deal->getAmountTotal() . "руб.<br>";

        echo "
        <div>Здравствуйте, $name!<br>
                 Ваш заказ отправлен $postDate (отправитель – Ларин С.В.).<br>
                 $amount
                 Почтовый идентификатор: $postId<br>
                 Отследить прохождение заказа можно <a traget='_blank' href='http://www.russianpost.ru/rp/servise/ru/home/postuslug/trackingpo'>здесь</a><br>
                 Всего доброго!<br>
                 $adminName, проект Вся Аюрведа.
        </div>
        ";
    }
}