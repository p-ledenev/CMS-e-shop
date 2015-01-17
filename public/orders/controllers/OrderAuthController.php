<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 8:49
 * To change this template use File | Settings | File Templates.
 */
class OrderAuthController extends Controller
{
    protected $password;
    protected $action;
    protected $rememberMe;

    /* @var Customer $customer */
    public function __construct(&$request, $cdata)
    {
        parent::__construct($request);

        if (!$this->getCustomer()->isPersisted()) {

            $this->getCustomer()->setEmail($cdata['email']);
            $this->getCustomer()->setName($cdata['name']);
            $this->getCustomer()->setPhone($cdata['phone']);
            $this->getCustomer()->setInMailing($cdata['sendme'] == "1" ? true : false);
        }

        $this->rememberMe = $cdata['remember_me'] ? true : false;
        $this->password = $cdata['password'];

        if ($cdata['customer_change'])
            $this->action = 'change';
        else if ($cdata['customer_new'])
            $this->action = 'new';
        else if ($cdata['customer_auth'])
            $this->action = 'auth';
    }

    /* @return View */
    protected function processOnController()
    {
        if ($this->getCustomer()->isPersisted())
            header("Location: http://$_SERVER[HTTP_HOST]/" . $this->getUrl() . "/");

        if ($this->action) {

            $response = $this->processAction();

            if (strlen($response['strErr']) <= 0)
                header("Location: http://$_SERVER[HTTP_HOST]/" . $this->getUrl() . "/");
        }

        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = $this->getMainView();
        $viewList[] = new SimpleTextView("</DIV>");

        $view = new MainView($this->request, Category::initEntity("Category"), $response['strErr'], $response['strInfo']);
        $view->setViewList($viewList);

        return $view;
    }

    protected function getMainView()
    {
        return new OrderAuthView($this->getCustomer());
    }

    protected function getUrl()
    {
        return "orders";
    }

    protected function processAction()
    {
        if ($this->action == 'change') {
            $this->getCustomer()->initEntityByEmail();
            $this->sendCustomerInfo();
            $strInfo = "Регистрационная информация отправлена на указанный email";
        }

        if ($this->action == 'new') {
            try {
                $password = $this->getCustomer()->generateRowPassword();
                $this->getCustomer()->prepareNewCustomerWith($password);

                $this->getCustomer()->persistEntitySafly();
                $this->getCustomer()->initEntityById();

                $this->sendNewCustomerInfo($password);

            } catch (Exception $e) {
                $strErr = "Указанные email уже зарегистрирован в системе";
            }
        }

        if ($this->action == 'auth') {
            try {
                if (!$this->getCustomer()->validateAuthorizationByEmail($this->password))
                    throw new Exception("Введенные данные неверны");

                if ($this->rememberMe) {
                    $manager = new CookieManager();
                    $manager->setCusotmerCookie($this->getCustomer());
                }

            } catch (Exception $e) {
                $strErr = $e->getMessage();
            }
        }

        return Array('strErr' => $strErr, 'strInfo' => $strInfo);
    }

    protected function sendCustomerInfo()
    {
        $view = new CustomerEmailInfoView($this->getCustomer());
        mail($this->getCustomer()->getEmail(), " Проект Вся Аюрведа - Информация для смены пароля", $view->getContent(),
            "From: market@ayurvedamarket.ru\nReply-to: market@ayurvedamarket.ru\nContent-type: text/html; charset=\"windows-1251\"\n");
    }


    protected function sendNewCustomerInfo($password)
    {
        $view = new CustomerNewEmailView($this->getCustomer(), $password);
        mail($this->getCustomer()->getEmail(), " Проект Вся Аюрведа - Ваша регистрационная запись создана",
            $view->getContent(), "From: market@ayurvedamarket.ru>\nReply-to: market@ayurvedamarket.ru>\nContent-type: text/html; charset=\"windows-1251\"\n");
    }
}

;

