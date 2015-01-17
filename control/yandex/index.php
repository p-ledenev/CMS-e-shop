<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = new YandexCategoryFilter("/control/yandex", false, true);
$categoryList = $filter->loadItemList("YandexCategory");

if ($_GET['delete'] == "yes" && $_GET['yid']) {
    $produce = YandexProduce::initEntityWithId("YandexProduce", $_GET['yid']);

    try {
        $produce->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

$viewList = Array();
$viewList[] = new SimpleTextView("<DIV class='switch font17 color2' style='padding:0 0 10px 0px'>яндекс каталог</DIV>");
$viewList[] = new YandexCategoryListView($categoryList);

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
