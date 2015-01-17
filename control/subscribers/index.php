<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['subscriberFilter']);

/* @var Subscriber $subscriber */
$subscriber = Subscriber::initEntity("Subscriber");

if ($_GET['delete'] == "yes" && $_GET['subscriber_id']) {
    $subscriber->setId($_GET['subscriber_id']);

    try {
        $subscriber->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new SubscriberFilter("control/subscribers");

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['subscriptionFilter'] = serialize($filter);

$subscriberList = $filter->loadItemList("Subscriber");

$viewList = Array();
$viewList[] = new SubscriberFilterView($filter);
$viewList[] = new NavigationView($filter->getNavigation());
$viewList[] = new SubscriberListTableView($subscriberList, "/control/subscribers");
$viewList[] = $viewList[1];

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";

