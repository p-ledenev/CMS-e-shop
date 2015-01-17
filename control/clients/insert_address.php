<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if (!$_REQUEST['cid']) die("Specify ID parameter");

$customer = Customer::initEntityWithId("Customer", $_REQUEST['cid']);

/* @var Address $address */
$address = Address::initEntity("Address");
$address->setCustomer($customer);

if ($_POST['padd']) {

    $address->fillEntityBy($_POST);
    $address->setNewId();

    try {
        $address->persistEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if (strlen($strErr) <= 0)
        $strErr = "<script> window.opener.document.location.reload(); window.close();</script>";
}

$viewList = Array();
$viewList[] = new CustomerInsertAddressView($address, "/control/clients/insert_address.php", $strErr, $strInfo);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
