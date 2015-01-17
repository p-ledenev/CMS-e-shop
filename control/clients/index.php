<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['clientFilter']);

/* @var Customer $customer */
$customer = Customer::initEntity("Customer");

if ($_GET['delete'] == "yes") {

    if ($_GET['id']) {
        /* @var Customer $customer */
        $customer = Customer::initEntityWithId("Customer", $_GET['id']);

        try {
            $strErr = $customer->removeEntitySafly();
        } catch (Exception $e) {
            $strErr = $e->getMessage();
        }
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new ClientFilter("/control/clients");

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['clientFilter'] = serialize($filter);

$customerList = $filter->loadItemList("Customer");

$viewList = Array();
$viewList[] = new CustomerFilterView($filter);
$viewList[] = new NavigationView($filter->getNavigation());
$viewList[] = new CustomerListTableView($customerList);
$viewList[] = $viewList[1];

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
