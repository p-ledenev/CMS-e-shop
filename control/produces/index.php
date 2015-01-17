<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['produceFilter']);

/* @var Produce $produce */
$produce = Produce::initEntity("Produce");

if ($_GET['delete'] == "yes" && $_GET['produce_id']) {
    $produce->setId($_GET['produce_id']);

    try {
        $produce->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new ProduceFilter("control/produces", Category::initEntityWithId("Category", Constants::$defaultCatalogId),
        ProducePartition::initEntityWithId("ProducePartition", Constants::$defaultPartitionId));

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['produceFilter'] = serialize($filter);

$produceList = $filter->loadItemList("Produce");

$viewList = Array();
$viewList[] = new ProduceFilterView($filter);
$viewList[] = new NavigationView($filter->getNavigation());
$viewList[] = new ProduceListTableView($produceList, "/control/produces");
$viewList[] = $viewList[1];

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";

