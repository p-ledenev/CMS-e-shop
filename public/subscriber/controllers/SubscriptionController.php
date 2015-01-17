<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 09.04.14
 * Time: 9:21
 */
abstract class SubscriptionController extends Controller
{
    protected $cdata;

    public function __construct(&$request, $cdata)
    {
        parent::__construct($request);

        $transformData = Array();
        foreach ($cdata as $key => $value)
            $transformData[$key] = mb_convert_encoding($value, "windows-1251", "utf-8");

        $this->cdata = $transformData;

        $this->cdata['type'] = $this->getSubscriptionType()->getCode();
    }

    /* @return View */
    protected function processOnController()
    {
        /* @var SubscriptionItem $subscriptionItem */
        $subscriptionItem = SubscriptionItem::initEntity("SubscriptionItem");

        $subscriptionItem->fillEntityBy($this->cdata);
        $subscriptionItem->generateConfirmationCode();
        $subscriptionItem->getSubscription()->setActive(true);

        $response = $this->processAction($subscriptionItem);

        $manager = new CookieManager();
        $manager->setSubscriberCookie($subscriptionItem->getSubscriber());

        return new SubscriptionView($response['strErr'], $response['strInfo']);
    }

    /* @param SubscriptionItem $subscriptionItem */
    protected function processAction($subscriptionItem)
    {
        try {
            if (!$subscriptionItem->getSubscriber()->isPersistedWithEmail()) {
                $subscriptionItem->getSubscriber()->setNewId();
                $subscriptionItem->getSubscriber()->persistEntitySafly();
            } else {
                $subscriptionItem->getSubscriber()->updateEntitySafly();
            }

            $subscriptionItem->setNewId();
            $subscriptionItem->persistEntitySafly();
            $this->sendSubscriberInfo($subscriptionItem);

        } catch (Exception $e) {
            $strErr = "Невозможно сохранить информацию. Обратитесь к администраторам магазина";

            if (strpos($e->getMessage(), 'Duplicate'))
                $strErr = $subscriptionItem->getErrorMessage();
        }

        return Array('strErr' => $strErr, 'strInfo' => $this->getSuccessSubscribeInfo());
    }


    /* @param SubscriptionItem $subscriptionItem */
    protected function sendSubscriberInfo($subscriptionItem)
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/unsubscribe/" . $subscriptionItem->getSubscription()->getConfirmationCode();
        $body = "<html><body>" . $this->getEmailBody($subscriptionItem) .
            "<DIV style='padding: 20px 0 0 0; text-size:12px;'>Если вы не оставляли этой заявки, то, чтобы отписаться
            от уведомлений, пройдите по ссылке: <a href='$url'>$url</a></DIV>
            </body></html>";

        mail($subscriptionItem->getSubscriber()->getEmail(),
            $this->getEmailTheme($subscriptionItem),
            $body,
            "From: market@ayurvedamarket.ru\r\nReply-to: market@ayurvedamarket.ru\r\nContent-type: text/html; charset=\"windows-1251\"\r\n");
    }

    /* @param SubscriptionItem $subscriptionItem */
    protected abstract function getEmailTheme($subscriptionItem);

    /* @param SubscriptionItem $subscriptionItem */
    protected abstract function getEmailBody($subscriptionItem);

    /* @return SubscriptionType */
    protected abstract function getSubscriptionType();

    protected function getSuccessSubscribeInfo()
    {
        return "Подписка успешно добавлена. Вам на почту отправлено информационное сообщение";
    }
} 