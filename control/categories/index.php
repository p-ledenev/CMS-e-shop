<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['categoryFilter']);

/* @var Category $category */
$category = Category::initEntity("Category");

if ($_GET['delete'] == "yes" && $_GET['category_id']) {
    $category->setId($_GET['category_id']);

    try {
        $category->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new CategoryFilter("/control/categories", CategoryType::$all, false);

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['categoryFilter'] = serialize($filter);

$categoryList = $filter->loadItemList("Category");

$viewList = Array();
$viewList[] = new CategoryFilterView($filter);
$viewList[] = new CategoryListTableView($categoryList, "/control/categories");

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
