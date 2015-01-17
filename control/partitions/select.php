<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if ($_REQUEST['form'] && $_REQUEST['field'] && $_REQUEST['type'] && $_REQUEST['default']) {

    $default = ($_SESSION['default_category']) ? $_SESSION['default_category'] : $_REQUEST['default'];

    $_SESSION['partitionSelectorForm'] = serialize(Array('form' => $_REQUEST['form'], 'field' => $_REQUEST['field'],
        'type' => $_REQUEST['type'], 'default' => $default));

    $category = Category::initEntityWithId("Category", $default);
    if (!$category->isPersisted())
        $category = Category::initEntityByUrl("Category", "food");

    $_SESSION['partitionSelectorFilter'] = serialize(
        new PartitionFilter("control/partitions/select.php", $category, null, false, false));
}

$selector = unserialize($_SESSION['partitionSelectorForm']);

/* @var PartitionFilter $filter */
$filter = unserialize($_SESSION['partitionSelectorFilter']);

if ($_POST['tser']) {
    $filter->setFilter($_POST);
    $_SESSION['default_category'] = $filter->getCategory()->getId();
}

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$categoryTypeClass = new ReflectionClass('CategoryType');

$viewList = Array();
$viewList[] = new PartitionFilterView($filter, $categoryTypeClass->getStaticPropertyValue($selector['type']));
$viewList[] = new PartitionSelectView($filter, $selector['form'], $selector['field']);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
