<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = new SubcategoryFilter("/control/subcategories/select.php", false);

$viewList = Array();
$viewList[] = new SubcategorySelectView($filter, $_REQUEST['form_name'], $_REQUEST['field_name']);

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
