<?
if (!$_REQUEST['id']) die("Specify ID parameter");

include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Deal $deal */
$deal = Deal::initEntityWithId("Deal", $_REQUEST['id']);

if ($_GET['delete'] == "yes" && $_GET['pid'] && $_GET['id']) {

    $deal->initEntityById();
    $produce = Produce::initEntityWithId("Produce", $_GET['pid']);
    $dealProduce = new DealProduce($produce, $deal);

    $deal->setProduceList($dealProduce->removeFrom($deal->getProduceList()));
    $dealProduce->removeEntity();
    $deal->reCountAmounts();

    try {
        $deal->updateEntitySafly();
        $strInfo = "Информация успешно сохранена";
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_POST['ofill'] || $_POST['cfill']) {

    $deal->initEntityById();
    $cuurentDealStatus = $deal->getStatus();

    $customer = $deal->getCustomer();
    $customer->initEntityById();

    $deal->fillEntityBy($_POST);
    $deal->getProduceList();

    $sendPostMail = false;
    if ($_POST['post_date'] && $_POST['amount_total'] && $_POST['post_id'] && $_POST['post_invoice']) {

        $sendPostMail = DealStatus::$received->equals($cuurentDealStatus);
        $deal->setStatus(DealStatus::$dispatch);
    }

    foreach ($_POST['produce_amount'] as $key => $amount) {
        if ($amount > 0) {
            $produce = Produce::initEntityWithId("Produce", $_POST['produce_id'][$key]);

            $dealProduce = $deal->getProduceBy($produce);
            $dealProduce->setAmount($amount);
            $deal->reCountAmounts();
        }
    }

    if ($_POST['add_produce'] && $_POST['add_produce_amount'] > 0) {
        /* @var Produce $produce */
        $produce = Produce::initEntityWithId("Produce", $_POST['add_produce']);
        $dealProduce = new DealProduce($produce, $deal, $produce->getPrice(), $_POST['add_produce_amount']);

        $strategy = DiscontStrategyFactory::createDiscontStrategy($deal->getCustomer(), $deal->getDiscontPercent());
        $deal->addProduce($dealProduce, $strategy);
    }

    if ($_POST['post_fname'] || $_POST['post_sname'] || $_POST['post_mname']) {

        $CDATA = Array(
            'post_fname' => $_POST['post_fname'],
            'post_sname' => $_POST['post_sname'],
            'post_mname' => $_POST['post_mname']);

        $customer->fillEntityBy($CDATA);
        try {
            $customer->updateEntitySafly();
            $strInfo = "Информация успешно сохранена";

        } catch (Exception $e) {
            $strErr = $e->getMessage();
        }
    }

    if ($sendPostMail) {
        $mailView = new DealMailPostView($deal, $administrator);

        $body = $mailView->getContent();
        $from = "From: market@ayurvedamarket.ru\nContent-type: text/html; charset=\"windows-1251\"\n";

        mail($customer->getEmail(), "=?windows-1251?b?" . base64_encode("Проект Вся Аюрведа: Ваш заказ отправлен") . "?=", $body, $from);
        mail("market@ayurvedamarket.ru", "=?windows-1251?b?" . base64_encode("(Копия) Проект «Вся Аюрведа»: Ваш заказ отправлен") . "?=", $body, $from);
    }

    try {
        $deal->updateEntitySafly();
        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        $strErr = "<script> window.location='http://$_SERVER[HTTP_HOST]/control/deals/'</script>";
}

$viewList = Array();
$viewList[] = new DealInsertView($deal);
$viewList[] = new DealPostFormView($deal);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";



