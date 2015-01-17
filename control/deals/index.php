<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['dealFilter']);

/* @var Deal $deal */
$deal = Deal::initEntity("Deal");

if ($_GET['delete'] == "yes" && $_GET['deal_id']) {
    $deal = Deal::initEntityWithId("Deal", $_GET['deal_id']);
    $deal->getProduceList();

    try {
        $deal->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_GET['change'] == "true" && $_GET['deal_id']) {

    $deal = Deal::initEntityWithId("Deal", $_GET['deal_id']);
    $deal->setStatus(DealStatus::getItemBy($_GET['status'], "DealStatus"));

    try {
        $deal->updateStatus();
    } catch (Exception $e) {

        $strErr = $e->getMessage();
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new DealFilter("control/deals", DealStatus::$all, 'a', time() - 7 * 24 * 60 * 60, time() + 24 * 60 * 60);

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['dealFilter'] = serialize($filter);

$dealList = $filter->loadItemList("Deal");

$viewList = Array();
$viewList[] = new DealFilterView($filter);
$viewList[] = new NavigationView($filter->getNavigation());
$viewList[] = new DealListTableView($dealList, "/control/deals");
$viewList[] = $viewList[1];
$viewList[] = new DealStatusSelectorView("/control/deals/");

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";

