<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var YandexProduce $produce */
$produce = YandexProduce::initEntity("YandexProduce");
$produce->setProduce(Produce::initEntity("Produce"));
$produce->setCategory(YandexCategory::initEntity("YandexCategory"));

if ($_REQUEST['id'] > 0)
    $produce = YandexProduce::initEntityWithId("YandexProduce", $_REQUEST['id']);

if ($_POST['ofill'] || $_POST['cfill']) {

    $produce->fillEntityBy($_POST);

    try {
        if ($produce->isPersisted()) {
            $produce->updateEntitySafly();
        } else {
            $produce->setNewId();
            $produce->persistEntitySafly();
        }

        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/yandex/'</script>";
}

$viewList = Array();
$viewList[] = new YandexProduceInsertView($produce);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";