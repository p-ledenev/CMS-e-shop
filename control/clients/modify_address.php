<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if (!$_REQUEST['aid']) die("Specify ID parameter");

/* @var Address $address */
$address = Address::initEntityWithId("Address", $_REQUEST['aid']);

if ($_POST['padd']) {

    $address->fillEntityBy($_POST);

    try {
        $address->updateEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if (strlen($strErr) <= 0)
        $strErr = "<script> window.opener.document.location.reload(); window.close();</script>";
}

$viewList = Array();
$viewList[] = new CustomerInsertAddressView($address, "/control/clients/modify_address.php", $strErr, $strInfo);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";