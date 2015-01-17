<?
class NewsSubscriberController extends SubscriberController
{
    /* @return Subscriber */
    protected function createSubscriber()
    {
        $subscriber = NewsSubscriber::initEntity("NewsSubscriber");

        return $subscriber;
    }

    /* @param Subscriber $subscriber */
    protected function getEmailTheme($subscriber)
    {
        return "������ ��� ������� - �������� �� ��������";
    }

    /* @param Subscriber $subscriber */
    protected function getEmailBody($subscriber)
    {
        return "<DIV style='padding: 0px 0 0 0; text-size:14px;'>�� ����������� �� �������������� �������� ������� ��� �������</DIV>";
    }
}

;