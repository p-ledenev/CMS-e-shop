<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var PreviewDescription $description */
$description = PreviewDescription::initEntity("PreviewDescription");
$description->setProduce(Produce::initEntityWithId("Produce", $_REQUEST['produce']));

if ($_REQUEST['id'] > 0)
    $description = PreviewDescription::initEntityWithId("PreviewDescription", $_REQUEST['id']);

if ($_GET['delete'] == "yes") {
    $description->initEntityByIdWithReferences();

    if ($_GET['iid']) {
        $image = new Image($description->getId(), ImageType::getItemBy($_GET['iid'], "ImageType"));
        $image->removeImage();
    }
}

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

        /* @var Image $image */
        $image = new Image($description->getId(), ImageType::$description);
        $image->saveImageFrom($_FILES, "image_" . $image->getType()->getCode());

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        echo "<script> window.opener.document.location.reload(); window.close();</script>";
}

$viewList = Array();
$viewList[] = new PreviewDescriptionInsertView($description, "/control/descriptions/insert_preview.php");

$view = new ControlMainViewProlog($administrator);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";