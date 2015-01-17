<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 18:16
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class OrderSendController extends Controller
{
    protected $deal;
    protected $cdata;

    /* @param Deal $deal */
    public function __construct(&$request, &$deal, $cdata)
    {
        parent::__construct($request);

        $this->deal = $deal;
        $this->cdata = $cdata;
    }

    /* @return View */
    protected function processOnController()
    {
        $response = $this->processAction();

        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new OrderSendView();
        $viewList[] = new SimpleTextView("</DIV'>");

        $view = new MainView($this->request, Category::initEntity("Category"), $response['strErr'], $response['strInfo']);

        if (strlen($response['strErr']) <= 0)
            $view->setViewList($viewList);

        $this->getCart()->clear();
        $this->deal->clear();

        return $view;
    }

    protected function processAction()
    {
        $deliveryTime = "c " . mysql_real_escape_string(substr($this->cdata['d_time_f'], 0, 2)) .
            " до " . mysql_real_escape_string(substr($this->cdata['d_time_t'], 0, 2));

        $this->getCart()->getDiscontStrategy()->readParamsFrom(Array("carnivalDiscontPercent" => "0"));
        $this->deal->fillBy($this->getCart());

        $this->deal->fillEntityBy($this->cdata);
        $this->deal->setDeliveryTime($deliveryTime);
        $this->deal->setNewId();
        $this->deal->setStatus(DealStatus::$received);
        $this->deal->setThedate(mktime());

        try {
            $this->deal->persistEntitySafly();
            $this->deal->initEntityById();
            $this->sendDealInfo();

        } catch (Exception $e) {
            $strErr = "Невозможно сохранить информацию. Обратитесь к администраторам магазина";
        }

        return Array('strErr' => $strErr, 'strInfo' => "");
    }

    protected function sendDealInfo()
    {
        $dealView = new EmailDealDetailView($this->deal);
        $giftView = new OrderGiftListView($this->deal);
        $cartView = new CabinetDealProduceListView($this->deal);

        $body = "<html><body>" . $dealView->getContent() . $giftView->getContent() . $cartView->getContent() . "</body></html>";

        mail($this->deal->getCustomer()->getEmail(),
            "Аюрведамаркет - Ваш заказ принят",
            $body,
            "From: market@ayurvedamarket.ru\r\nReply-to: market@ayurvedamarket.ru\r\nContent-type: text/html; charset=\"windows-1251\"\r\n");

        mail("market@ayurvedamarket.ru",
            "Аюрведамаркет - копия заказа",
            $body,
            "From: market@ayurvedamarket.ru\r\nReply-to: market@ayurvedamarket.ru\r\nContent-type: text/html; charset=\"windows-1251\"\r\n");

    }
}