<?
error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);

/* @var Controller $controller */
include $_SERVER['DOCUMENT_ROOT'] . "/public/prolog.php";

list ($PARENT, $ITEM) = explode("/", $_SERVER["QUERY_STRING"]);
if (strpos($ITEM, "page") !== false) $ITEM = "";

//logout
if ($PARENT == "logout") {
    $controller = new CabinetLogoutControler($request);
}

// club
if ($PARENT == "club") {
    $controller = new ClubController($request);
}

// look throught cart
if (is_null($controller) && ($PARENT == "cartadd" || $PARENT == "cartclear")) {
    $produce = Produce::initEntityWithId("Produce", $ITEM);
    $controller = new PopupCartController($request, $PARENT, $produce, $_POST['amount']);
}

// cart
if (is_null($controller) && $PARENT == "showcart") {
    $controller = new ShowCartController($request, $_POST);
}

// personal cabinet
if (is_null($controller) && $PARENT == "cauth")
    $controller = new CabinetAuthController($request, $_POST);

if (is_null($controller) && $PARENT == "cabinet") {
    if ($ITEM) {
        $deal = Deal::initEntityWithId("Deal", $ITEM);
        $controller = new CabinetDealController($request, $deal);
    } else {
        $controller = new CabinetIndexController($request);
    }
}

// search
if (is_null($controller) && $PARENT == "search") {
    $controller = new SearchController($request, $_POST);
}

// subscription form for produce
if (is_null($controller) && $PARENT == "produce_notice_form") {
    $controller = new ProduceSubscribeFormController($request, $ITEM);
}

// subscription form for club sales
if (is_null($controller) && $PARENT == "club_sales_form") {
    $controller = new ClubSalesSubscribeFormController($request);
}

// subscribe for news
if (is_null($controller) && $PARENT == "news_subscribe") {
    $controller = new NewsSubscriptionController($request, $_POST);
}

// subscribe for produce
if (is_null($controller) && $PARENT == "produce_notice_subscribe") {
    $controller = new ProduceSubscriptionController($request, $_POST);
}

// subscribe for club sales
if (is_null($controller) && $PARENT == "club_sales_subscribe") {
    $controller = new ClubSalesSubscriptionController($request, $_POST);
}

// subscribe for club info
if (is_null($controller) && $PARENT == "club_info_subscribe") {
    $controller = new ClubInfoSubscriptionController($request, $_POST);
}

// subscribe for club activity
if (is_null($controller) && $PARENT == "club_activity_subscribe") {
    $controller = new ClubActivitySubscriptionController($request, $_POST);
}

// subscribe for club workshop
if (is_null($controller) && $PARENT == "club_workshop_subscribe") {
    $controller = new ClubWorkshopSubscriptionController($request, $_POST);
}

// unsubscribe
if (is_null($controller) && $PARENT == "unsubscribe") {
    $controller = new UnsubscribeController($request, $ITEM);
}

// make an order
if (is_null($controller) && $PARENT == "auth") {
    $controller = new OrderAuthController($request, $_POST);
}

if (is_null($controller) && $PARENT == "orders") {
    $controller = new OrderIndexController($request, $deal, $_POST);
}

if (is_null($controller) && $PARENT == "make") {
    $controller = new OrderMakeController($request, $deal);
}

if (is_null($controller) && $PARENT == "send") {
    $controller = new OrderSendController($request, $deal, $_POST);
}

if (is_null($controller) && $PARENT == "change") {
    $controller = new CabinetChangeController($request, $ITEM);
}

if (is_null($controller) && $PARENT == "captcha") {
    $controller = new ShowCaptchaController($request, $captcha);
}

if (is_null($controller)) {

    /* @var Partition $partition */
    $partition = Partition::initEntityByUrl($PARENT);

    if ($partition->isPersisted()) {

        if (CategoryType::$market->equals($partition->getCategory()->getType())) {
            if ($ITEM) {
                $produce = Produce::initEntityWithId("Produce", $ITEM);
                $controller = new ProduceDetailController($request, $produce, $partition, $captcha, $_POST);
            } else {
                $controller = new ProduceListController($request, $partition, $_GET['page']);
            }
        }

        if (CategoryType::$material->equals($partition->getCategory()->getType())) {
            $article = Article::initEntityWithId("Article", $ITEM);
            $controller = new ArticleDetailController($request, $article, $partition, $captcha, $_POST);
        }
    }
}

$controller->process()->view();

include $_SERVER['DOCUMENT_ROOT'] . "/public/epilog.php";