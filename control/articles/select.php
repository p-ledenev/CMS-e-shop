<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if ($_REQUEST['form'] && $_REQUEST['field'])
    $_SESSION['articleSelectorForm'] = serialize(Array('form' => $_REQUEST['form'], 'field' => $_REQUEST['field']));

$selector = unserialize($_SESSION['articleSelectorForm']);
$filter = unserialize($_SESSION['articleSelectorFilter']);

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new ArticleFilter("control/articles/select.php", Category::initEntityWithId("Category", 13043),
        articlePartition::initEntityWithId("articlePartition", 13054));

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['articleSelectorFilter'] = serialize($filter);

$viewList = Array();
$viewList[] = new ArticleFilterView($filter);
$viewList[] = new ArticleSelectView($filter, $selector['form'], $selector['field']);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
