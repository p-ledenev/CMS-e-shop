<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var ProducePartition $partition */
$partition = ProducePartition::initEntity("ProducePartition");
$partition->setCategory(Category::initEntity("Category"));
$partition->setSubcategory(Subcategory::initEntity("Subcategory"));

if ($_REQUEST['id'] > 0)
    $partition = partition::initEntityWithId("ProducePartition", $_REQUEST['id']);

if ($_GET['delete'] == "yes") {

    if ($_GET['iid']) {
        $image = new Image($partition->getId(), ImageType::getItemBy($_GET['iid'], "ImageType"));
        $image->removeImage();
    }
}

if ($_POST['ofill'] || $_POST['cfill']) {

    $partition->fillEntityBy($_POST);

    try {
        if ($partition->isPersisted()) {
            $partition->updateEntitySafly();
        } else {
            $partition->setNewId();
            $partition->persistEntitySafly();
        }

        $imageList = Array();
        $imageList[] = new Image($partition->getId(), ImageType::$partition);
        $imageList[] = new Image($partition->getId(), ImageType::$tops);
        $imageList[] = new Image($partition->getId(), ImageType::$promotionPreview);
        $imageList[] = new Image($partition->getId(), ImageType::$promotionDetail);

        /* @var Image $image */
        foreach ($imageList as $image)
            $image->saveImageFrom($_FILES, "image_" . $image->getType()->getCode());

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/partitions/'</script>";
}

$viewList = Array();
$viewList[] = new PartitionInsertView($partition);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";
