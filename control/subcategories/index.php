<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Subcategory $subcategory */
$subcategory = Subcategory::initEntity("Subcategory");

if ($_GET['delete'] == "yes" && $_GET['subcategory_id']) {
    $subcategory->setId($_GET['subcategory_id']);

    try {
        $subcategory->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

$filter = new SubcategoryFilter("/control/subcategories", false);
$subcategoryList = $filter->loadItemList("Subcategory");

$viewList = Array();
$viewList[] = new SubcategoryListTableView($subcategoryList, "/control/subcategories");

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
