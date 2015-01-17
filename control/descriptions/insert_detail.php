<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var DetailDescription $description */
$description = DetailDescription::initEntity("DetailDescription");
$description->setProduce(Produce::initEntityWithId("Produce", $_REQUEST['produce']));

if ($_REQUEST['id'] > 0)
    $description = DetailDescription::initEntityWithId("DetailDescription", $_REQUEST['id']);

if ($_POST['ofill'] || $_POST['cfill']) {

    $description->initEntityByIdWithReferences();

    $description->fillEntityBy($_POST);

    try {
        if ($description->isPersisted()) {
            $description->updateEntitySafly();
        } else {
            $description->setNewId();
            $description->persistEntitySafly();
        }

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        echo "<script> window.opener.document.location.reload(); window.close();</script>";
}

$viewList = Array();
$viewList[] = new DetailDescriptionInsertView($description, "/control/descriptions/insert_detail.php");

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";