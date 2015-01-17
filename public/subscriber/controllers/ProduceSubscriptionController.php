<?

class ProduceSubscriptionController extends SubscriptionController
{
    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailTheme($subscriptionItem)
    {
        return "������ ��� ������� - ����������� � �������";
    }

    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailBody($subscriptionItem)
    {
        /* @var Produce $produce */
        $produce = $subscriptionItem->getSubscription()->getItem();
        $title = $produce->getTitle();

        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>�� ��������� ��������� ��� � ������� �������� $title</DIV>";
    }

    /* @return SubscriptionType */
    protected function getSubscriptionType()
    {
        return SubscriptionType::$toProduce;
    }
}

;