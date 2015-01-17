<?
class NewsSubscriptionController extends SubscriptionController
{
    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailTheme($subscriptionItem)
    {
        return "Проект Вся Аюрведа - подписка на рассылку";
    }

    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailBody($subscriptionItem)
    {
        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>Вы подписались на информационную рассылку проекта Вся Аюрведа</DIV>";
    }

    /* @return SubscriptionType */
    protected function getSubscriptionType()
    {
        return SubscriptionType::$toNews;
    }
}

;