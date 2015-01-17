<?
class ProduceSubscriberController extends SubscriberController
{
    /* @return Subscriber */
    protected function createSubscriber()
    {
        $subscriber = ProduceSubscriber::initEntity("ProduceSubscriber");

        return $subscriber;
    }

    /* @param Subscriber $subscriber */
    protected function getEmailTheme($subscriber)
    {
        return "Проект Вся Аюрведа - уведомление о наличии";
    }

    /* @param Subscriber $subscriber */
    protected function getEmailBody($subscriber)
    {
        /* @var Produce $produce */
        $produce = $subscriber->getItem();
        $title = $produce->getTitle();

        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>Вы попросили уведомить Вас о наличии продукта $title</DIV>";
    }
}

;