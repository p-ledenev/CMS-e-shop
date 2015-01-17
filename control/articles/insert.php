<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Article $article */
$article = Article::initEntity("Article");
$article->setPartition(ArticlePartition::initEntity("ArticlePartition"));
$article->setDate(time());
$article->setLoaded(true);

if ($_REQUEST['id'] > 0)
    $article = Article::initEntityWithId("Article", $_REQUEST['id']);

if ($_GET['delete'] == "yes") {
    $article->initEntityByIdWithReferences();

    if ($_GET['pid'])
        $article->removeProduceProgramItem(Article::initEntityWithId("Produce", $_GET['pid']));

    if ($_GET['rid'])
        $article->removeProgramItem(article::initEntityWithId("Article", $_GET['rid']));

    if ($_GET['iid']) {
        $image = new Image($article->getId(), ImageType::getItemBy($_GET['iid'], "ImageType"));
        $image->removeImage();
    }

    try {
        $article->updateEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_POST['ofill'] || $_POST['cfill']) {

    $article->initEntityByIdWithReferences();

    $article->fillEntityBy($_POST);

    try {
        if ($article->isPersisted()) {
            $article->updateEntitySafly();
        } else {
            $article->setNewId();
            $article->persistEntitySafly();
        }

        /* @var Image[] $imageList */
        $imageList[] = new Image($article->getId(), ImageType::$articlePreview);
        $imageList[] = new Image($article->getId(), ImageType::$articleDetail);

        foreach ($imageList as $image)
            $image->saveImageFrom($_FILES, "image_" . $image->getType()->getCode());

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/articles/'</script>";
}

$viewList = Array();
$viewList[] = new ArticleInsertView($article);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";