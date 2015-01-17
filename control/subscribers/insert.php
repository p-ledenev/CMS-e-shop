<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

/* @var Subscriber $subscriber */
$subscriber = Subscriber::initEntity("Subscriber");

if ($_REQUEST['id'] > 0)
    $subscriber = Subscriber::initEntityWithId("Subscriber", $_REQUEST['id']);

if ($_GET['delete'] == "yes" && $_GET['subscription_id']) {
    /* @var SubscriptionItem $subscription */
    $subscription = SubscriptionItem::initEntityWithId("SubscriptionItem", $_GET['subscription_id']);

    $subscriber->initEntityByIdWithReferences();
    $subscriber->removeSubscriptionItem($subscription);

    try {
        $subscription->removeEntitySafly();

    } catch (Exception $e) {

        $strErr = $e->getMessage();
    }
}

$viewList = Array();
$viewList[] = new SubscriberDetailView($subscriber);

$view = new ControlMainView($permissionController, $strErr, $strInfo);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";