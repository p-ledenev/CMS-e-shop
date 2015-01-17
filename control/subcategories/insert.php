<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Subcategory $subcategory */
$subcategory = ($_REQUEST['id'] > 0) ? Subcategory::initEntityWithId("Subcategory", $_REQUEST['id']) : Subcategory::initEntity("Subcategory");

if ($_GET['delete'] == "yes") {

    if ($_GET['iid']) {
        $image = new Image($subcategory->getId(), ImageType::getItemBy($_GET['iid'], "ImageType"));
        $image->removeImage();
    }
}

if ($_POST['ofill'] || $_POST['cfill']) {

    $subcategory->fillEntityBy($_POST);

    try {
        if ($subcategory->isPersisted()) {
            $subcategory->updateEntitySafly();
        } else {
            $subcategory->setNewId();
            $subcategory->persistEntitySafly();
        }

        $image = new Image($subcategory->getId(), ImageType::$subcategory);
        $image->saveImageFrom($_FILES, "image_" . $image->getType()->getCode());

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/subcategories/'</script>";
}

$viewList = Array();
$viewList[] = new SubcategoryInsertView($subcategory);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";