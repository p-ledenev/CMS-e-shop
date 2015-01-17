<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = new YandexCategoryFilter("/control/yandex/select.php");

$viewList = Array();
$viewList[] = new YandexCategoryLeafSelectView($filter, $_REQUEST['form'], $_REQUEST['field']);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
