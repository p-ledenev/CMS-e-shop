<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Produce $produce */
$produce = Produce::initEntity("Produce");
$produce->setQuantity(ProduceQuantity::$unknown);

if ($_REQUEST['id'] > 0)
    $produce = Produce::initEntityWithId("Produce", $_REQUEST['id']);

if ($_GET['delete'] == "yes") {
    $produce->initEntityByIdWithReferences();

    if ($_GET['pid'])
        $produce->removePartitionItem(ProducePartition::initEntityWithId("ProducePartition", $_GET['pid']));

    if ($_GET['aid'])
        $produce->removeArticleProgramItem(Article::initEntityWithId("Article", $_GET['aid']));

    if ($_GET['rid'])
        $produce->removeProgramItem(Produce::initEntityWithId("Produce", $_GET['rid']));

    if ($_GET['iid']) {
        $image = new Image($produce->getId(), ImageType::getItemBy($_GET['iid'], "ImageType"));
        $image->removeImage();
    }

    if ($_GET['comment_id']) {
        $comment = ProduceComment::initEntityWithId("ProduceComment", $_GET['comment_id']);
        $comment->removeEntitySafly();
    }

    if ($_GET['description']) {
        $description = Description::initEntityWithId("DetailDescription", $_GET['description']);
        $produce->removeDescriptionItem($description);
        $description->removeEntity();
    }

    try {
        $produce->updateEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_POST['ofill'] || $_POST['cfill']) {

    $produce->initEntityByIdWithReferences();
    $previousQuantity = $produce->getQuantity();

    $produce->fillEntityBy($_POST);

    try {
        if ($produce->isPersisted()) {
            $produce->updateEntitySafly();

            if (!$previousQuantity->equals(ProduceQuantity::$presence) && $produce->isPresence())
                $produce->notifySubscribers();

        } else {
            $produce->setNewId();
            $produce->persistEntitySafly();
        }

        /* @var Image[] $imageList */
        $imageList[] = new Image($produce->getId(), ImageType::$catalog);
        $imageList[] = new Image($produce->getId(), ImageType::$catalog2);
        $imageList[] = new Image($produce->getId(), ImageType::$sertificate);

        foreach ($imageList as $image)
            $image->saveImageFrom($_FILES, "image_" . $image->getType()->getCode());

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/produces/'</script>";
}

$viewList = Array();
$viewList[] = new ProduceInsertView($produce);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";