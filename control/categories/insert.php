<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Category $category */
$category = Category::initEntity("Category");
$category->setType(CategoryType::$unknown);

if ($_REQUEST['id'] > 0)
    $category = Category::initEntityWithId("Category", $_REQUEST['id']);

if ($_GET['delete'] == "yes") {

    if ($_GET['iid']) {
        $image = new Image($category->getId(), ImageType::getItemBy($_GET['iid'], "ImageType"));
        $image->removeImage();
    }
}

if ($_POST['ofill'] || $_POST['cfill']) {

    $category->fillEntityBy($_POST);

    try {
        if ($category->isPersisted()) {
            $category->updateEntitySafly();
        } else {
            $category->setNewId();
            $category->persistEntitySafly();
        }

        $imageList = Array();
        $imageList[] = new Image($category->getId(), ImageType::$category);
        $imageList[] = new Image($category->getId(), ImageType::$category2);

        /* @var Image $image */
        foreach($imageList as $image)
            $image->saveImageFrom($_FILES, "image_" . $image->getType()->getCode());

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/categories/'</script>";
}

$viewList = Array();
$viewList[] = new CategoryInsertView($category);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";