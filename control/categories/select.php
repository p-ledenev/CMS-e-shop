<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if ($_REQUEST['form'] && $_REQUEST['field'])
    $_SESSION['categorySelectorForm'] = serialize(Array('form' => $_REQUEST['form'], 'field' => $_REQUEST['field']));

$selector = unserialize($_SESSION['categorySelectorForm']);
$filter = unserialize($_SESSION['categorySelectorFilter']);

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new CategoryFilter("control/categories/select.php", CategoryType::$all, false);

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['categorySelectorFilter'] = serialize($filter);

$viewList = Array();
$viewList[] = new CategoryFilterView($filter);
$viewList[] = new CategorySelectView($filter, $selector['form'], $selector['field']);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";