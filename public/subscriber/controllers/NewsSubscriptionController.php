<?
class NewsSubscriptionController extends SubscriptionController
{
    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailTheme($subscriptionItem)
    {
        return "������ ��� ������� - �������� �� ��������";
    }

    /* @param SubscriptionItem $subscriptionItem */
    protected function getEmailBody($subscriptionItem)
    {
        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>�� ����������� �� �������������� �������� ������� ��� �������</DIV>";
    }

    /* @return SubscriptionType */
    protected function getSubscriptionType()
    {
        return SubscriptionType::$toNews;
    }
}

;