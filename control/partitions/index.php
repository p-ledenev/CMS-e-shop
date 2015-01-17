<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['partitionFilter']);

/* @var ProducePartition $partition */
$partition = ProducePartition::initEntity("ProducePartition");

if ($_GET['delete'] == "yes" && $_GET['partition_id']) {
    $partition->setId($_GET['partition_id']);
    try {
        $partition->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new PartitionFilter("control/partitions", Category::initEntityWithId("Category", Constants::$defaultCatalogId), null, false, false);

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['partitionFilter'] = serialize($filter);

$partitionList = $filter->loadItemList("ProducePartition");

$viewList = Array();
$viewList[] = new PartitionFilterView($filter, CategoryType::$all);
$viewList[] = new NavigationView($filter->getNavigation());
$viewList[] = new PartitionListTableView($partitionList, "/control/partitions");
$viewList[] = $viewList[1];

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
