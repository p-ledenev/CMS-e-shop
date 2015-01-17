<?
error_reporting(~E_STRICT & ~E_NOTICE & ~E_WARNING);

ini_set('session.gc_maxlifetime', 1209600);
ini_set('session.cookie_lifetime', 1209600);
session_set_cookie_params(1209600, "/");

session_start();

include "autoload.php";

if ($_GET['logout'] == "yes") {
    session_unset();
    session_destroy();
}

DealStatus::enumerate();
ProduceQuantity::enumerate();
ImageType::enumerate();
Paymethod::enumerate();
CategoryType::enumerate();
GiftAmount::enumerate();
CommentType::enumerate();
SubscriptionType::enumerate();
Doshe::enumerate();
EffectDirection::enumerate();
ClientFilterProperty::enumerate();
ClientAttribute::enumerate();
ClientSortField::enumerate();
SortOrder::enumerate();
SubscriberType::enumerate();

$base = Repository::newDBConnection("portal");
PersistableEntity::$base = $base;
Filter::$base = $base;

Image::$serverPath = $_SERVER["DOCUMENT_ROOT"] . "/upload/";
Image::$webPath = "/upload/";

$administrator = unserialize($_SESSION['administrator']);

$permissionController = new PermissionManager($administrator);
$permissionController->allowContent($_SERVER['REQUEST_URI']);