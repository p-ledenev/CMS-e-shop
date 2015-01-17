<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if ($_REQUEST['form'] && $_REQUEST['field'])
    $_SESSION['produceSelectorForm'] = serialize(Array('form' => $_REQUEST['form'],
                                                       'field' => $_REQUEST['field'],
                                                       'field_name' => $_REQUEST['field_name']));

$selector = unserialize($_SESSION['produceSelectorForm']);

/* @var ProduceFilter $filter */
$filter = unserialize($_SESSION['produceSelectorFilter']);

if ($_REQUEST['tres'])
    unset($filter);

$default_category = ($_SESSION['default_category']) ? $_SESSION['default_category'] : Constants::$defaultCatalogId;
$default_partition = ($_SESSION['default_partition']) ? $_SESSION['default_partition'] : Constants::$defaultPartitionId;

if (!$filter)
    $filter = new ProduceFilter("control/produces/select.php", Category::initEntityWithId("Category", $default_category),
        ProducePartition::initEntityWithId("ProducePartition", $default_partition));

if ($_POST['tser']) {
    $filter->setFilter($_POST);

    $_SESSION['default_category'] = $filter->getCategory()->getId();
    $_SESSION['default_partition'] = ($filter->getPartition() != null) ? $filter->getPartition()->getId() : "";
}

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['produceSelectorFilter'] = serialize($filter);

$viewList = Array();
$viewList[] = new ProduceFilterView($filter);
$viewList[] = new ProduceSelectView($filter, $selector['form'], $selector['field'], $selector['field_name']);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
