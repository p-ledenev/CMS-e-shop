<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if (!$_REQUEST['id']) die("Specify ID parameter");

/* @var Customer $customer */
$customer = Customer::initEntityWithId("Customer", $_REQUEST['id']);

if ($_GET['change'] == "true" && $_GET['deal_id']) {
    /* @var Deal $deal */
    $deal = Deal::initEntityWithId("Deal", $_GET['deal_id']);
    $deal->setStatus(DealStatus::getItemBy($_GET['status'], "DealStatus"));

    try {
        $deal->updateStatus();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_GET['delete'] == "yes" && $_GET['deal_id']) {
    /* @var Deal $deal */
    $deal = Deal::initEntityWithId("Deal", $_GET['deal_id']);
    $deal->getProduceList();

    try {
        $deal->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_GET['delete'] == "yes" && $_GET['aid']) {
    /* @var Address $address */
    $address = Address::initEntityWithId("Address", $_GET['aid']);

    try {
        $address->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

}

if ($_POST['ofill'] || $_POST['cfill']) {

    $customer->fillEntityBy($_POST);

    try {
        $customer->updateEntitySafly();
        $strInfo = "Информация успешно сохранена";
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/clients/'</script>";

}

$viewList = Array();
$viewList[] = new CustomerDetailFormView($customer);

if (count($customer->getReportList()) > 0)
    $viewList[] = new CustomerPollListView($customer);

$viewList[] = new CustomerAddressListView($customer);
$viewList[] = new SimpleTextView("<DIV class='switch font17 color2' style='padding:20px 0 10px 0;'>Заказы клиента</DIV>");
$viewList[] = new DealListTableView($customer->getDealList(), "/control/clients/insert.php?id=" . $customer->getId());
$viewList[] = new CustomerProduceListContextView($customer);
$viewList[] = new DealStatusSelectorView("/control/clients/insert.php?id=" . $customer->getId());

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
