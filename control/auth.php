<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Customer $customer */
$customer = Customer::initEntity("Customer");

if ($_POST['c_auth']) {

    $customer->setLogin($_POST['login']);

    if ($customer->isAuthorizedByLogin($_POST['password'])) {

        $_SESSION['administrator'] = serialize($customer);
        header("Location: http://$_SERVER[HTTP_HOST]/control/deals/");
    }

    $strErr = "Авторизация неудачна";
}

$viewList[] = new AuthView($strErr);

$view = new ControlMainViewProlog($customer);
$view->setViewList($viewList);
$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
