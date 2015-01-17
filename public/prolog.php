<?
error_reporting(~E_STRICT & ~E_NOTICE & ~E_WARNING);

session_start();
header('Content-type: text/html; charset=windows-1251');

include "autoload.php";

if ($_GET['logout'] == "yes") {
    session_unset();
    session_destroy();
}

Doshe::enumerate();
EffectDirection::enumerate();
DealStatus::enumerate();
ProduceQuantity::enumerate();
ImageType::enumerate();
Paymethod::enumerate();
CategoryType::enumerate();
GiftAmount::enumerate();
CommentType::enumerate();
SubscriptionType::enumerate();
SubscriberType::enumerate();
ClientFilterProperty::enumerate();
ClientAttribute::enumerate();
SortOrder::enumerate();
ClientSortField::enumerate();

$base = Repository::newDBConnection("portal");
PersistableEntity::$base = $base;
Filter::$base = $base;

Image::$serverPath = $_SERVER["DOCUMENT_ROOT"] . "/upload/";
Image::$webPath = "/upload/";

$cart = unserialize($_SESSION['customerCart']);
$customer = unserialize($_SESSION['customer']);
$deal = unserialize($_SESSION['deal']);
$administrator = unserialize($_SESSION['administrator']);
$captcha = unserialize($_SESSION['capthca']);

if (!$customer) {
    $customer = Customer::initEntity("Customer");
    $_SESSION['customer'] = serialize($customer);
}

$manager = new CookieManager();
$subscriber = Subscriber::initEntity("Subscriber");
$manager->fillSubscriberByCookie($subscriber);

$discontStrategy = DiscontStrategyFactory::createDiscontStrategy($customer);
$giftStrategyList[] = new AnyDealGiftStrategy();
$giftStrategyList[] = new DealAmountGiftStrategy(0);
$giftStrategyList[] = new LoyalCustomerGiftStrategy($customer);

if (!$cart)
    $cart = new Cart();

$cart->setDiscontStrategy($discontStrategy);
$cart->setGiftStrategy($giftStrategyList);

/* @var Customer $administrator */
if (!$administrator) {
    $administrator = Customer::initEntity("Customer");
    $administrator->setName("Public Web");
    $_SESSION['administrator'] = serialize($administrator);
}

if (!$deal) {
    $deal = Deal::initEntity("Deal");
    $_SESSION['deal'] = serialize($deal);
}

if (!$captcha)
    $captcha = new Captcha();

$request = new GeneralRequest($cart, $customer, $subscriber);