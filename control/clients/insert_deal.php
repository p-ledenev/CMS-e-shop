<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

if (!$_REQUEST['customer'] || !$_REQUEST['address'])
    die("Customer and address should be specify");

$customer = Customer::initEntityWithId("Customer", $_REQUEST['customer']);
$address = Address::initEntityWithId("Address", $_REQUEST['address']);
$produce = Produce::initEntity("Produce");

$produceList = Array();
for ($i = 0; $i < 5; $i++)
    $produceList[] = new DealProduce($produce, null, "", "");

/* @var Deal $deal */
$deal = Deal::initEntity("Deal");
$deal->setCustomer($customer);
$deal->setAddress($address);
$deal->setProduceList($produceList);
$deal->setPaymethod(Paymethod::$money);

if ($_POST['cfill']) {

    $strategy = DiscontStrategyFactory::createDiscontStrategy($deal->getCustomer());
    $deal->setProduceList(null);
    $deal->setNewId();

    foreach ($_POST['deal_produce'] as $key => $item) {

        if ($item == null || $item <= 0)
            continue;

        /* @var Produce $produce */
        $produce = Produce::initEntityWithId("Produce", $item);
        $dealProduce = new DealProduce($produce, $deal, $produce->getPrice(), $_POST['deal_amount'][$key]);
        $deal->addProduce($dealProduce, $strategy);
    }

    $paymethod = Paymethod::getItemBy($_POST['paymethod'], "Paymethod");
    $deliveryTime = "c " . mysql_real_escape_string(substr($_POST["d_time_f"], 0, 2)) . " до " . mysql_real_escape_string(substr($_POST["d_time_t"], 0, 2));
    $gift = mysql_real_escape_string(substr($_POST["gift"], 0, 255));

    $deal->setThedate(time());
    $deal->setStatus(DealStatus::$received);
    $deal->setDiscontPercent($strategy->getCustomerDiscontPercent());

    $deal->setPaymethod($paymethod);
    $deal->setDeliveryTime($deliveryTime);
    $deal->setGift($gift);

    try {
        $deal->persistEntitySafly();
        $strInfo = "Информация успешно сохранена";

    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }

    if ($_POST['cfill'] && strlen($strErr) <= 0)
        echo "<script> window.location='http://$_SERVER[HTTP_HOST]/control/deals/insert.php?id=" . $deal->getId() . "'</script>";
}

$viewList = Array();
$viewList[] = new CustomerInsertDealView($deal);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";