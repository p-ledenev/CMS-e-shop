<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['subscrptionFilter']);

if ($_GET['delete'] == "yes" && $_GET['subscription_id']) {
    $subscrption = SubscriptionItem::initEntityWithId("SubscriptionItem", $_GET['subscription_id']);

    try {
        $subscrption->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new SubscriptionFilter("control/subscriptions");

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['subscrptionFilter'] = serialize($filter);

$subscrptionList = $filter->loadItemList("SubscriptionItem");

$viewList = Array();
$viewList[] = new SubscriptionFilterView($filter);
$viewList[] = new NavigationView($filter->getNavigation());
$viewList[] = new SubscriptionListTableView($subscrptionList, "/control/subscrptions");
$viewList[] = $viewList[1];

$view = new ControlMainView($permissionController);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";

