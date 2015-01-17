<?
if (!$_SERVER["DOCUMENT_ROOT"]) $_SERVER["DOCUMENT_ROOT"] = "/home/avnc/data/www/ayurvedamarket.ru";
if (!$_SERVER["HTTP_HOST"]) $_SERVER["HTTP_HOST"] = "ayurvedamarket.ru";

include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$produceFilter = new YandexProduceFilter("/control/yandex");
$categoryFilter = new YandexCategoryFilter("/control/yandex", false);

/* @var YandexProduce[] $produceList */
$produceList = $produceFilter->loadItemList("YandexProduce");

/* @var YandexCategory[] $categoryList */
$categoryList = $categoryFilter->loadItemList("YandexCategory");

$fp = fopen($_SERVER["DOCUMENT_ROOT"] . "/yandex/catalog.xml", "w+");
if (!$fp) exit();

$head = "<?xml version=\"1.0\" encoding=\"windows-1251\"?>\n" .
    "<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">\n" .
    "<yml_catalog date=\"" . date("Y-m-d H:i") . "\">\n" .
    "<shop>\n" .
    "\t<name>Аюрведа Маркет</name>\n" .
    "\t<company>Аюрведический интернет магазин</company>\n" .
    "\t<url>http://www.ayurvedamarket.ru/</url>\n\n" .
    "\t<currencies>\n" .
    "\t\t<currency id=\"RUR\" rate=\"1\"/>\n" .
    "\t</currencies>\n\n";
fwrite($fp, $head);

$categoriesHead = "\t<categories>\n";
fwrite($fp, $categoriesHead);

foreach ($categoryList as $category) {

    if ($category->getParent() != null) {

        $strCategories = "\t\t<category id=\"" . $category->getId() . "\" parentId=\"" . $category->getParent()->getId() . "\">" .
            stripslashes(htmlspecialchars($category->getName(), ENT_QUOTES, "windows-1251")) . "</category>\n";

    } else {

        $strCategories = "\t\t<category id=\"" . $category->getId() . "\">" .
            stripslashes(htmlspecialchars($category->getName(), ENT_QUOTES, "windows-1251")) . "</category>\n";
    }

    fwrite($fp, $strCategories);
}

$categoriesFoot = "\t</categories>\n\n";
fwrite($fp, $categoriesFoot);

$offersHead = "\t<offers>\n";
fwrite($fp, $offersHead);

foreach ($produceList as $yandexProduce) {
    $produce = $yandexProduce->getProduce();
    $image = new Image($produce->getId(), ImageType::$catalog);

    if (!$produce->isPresence())
        continue;

    $avlbl = ($produce->isPresence()) ? "true" : "false";
    $rate = ($yandexProduce->getRate() > 0) ? " bid=\"" . $c['rate'] . "\"" : "";
    $url = "http://" . $_SERVER["HTTP_HOST"] . $produce->createUrlFor();
    $picture = ($image->exist()) ? "http://" . $_SERVER["HTTP_HOST"] . $image->getThumbUrl() : "";
    $description = ($yandexProduce->hasDescription()) ? $yandexProduce->getDescription() : $produce->getPreview();

    $offer = "\t\t<offer id=\"" . $c['id'] . "\" type=\"vendor.model\" available=\"" . $avlbl . "\"" . $rate . ">\n" .
        "\t\t\t<url>" . $url . "</url>\n" .
        "\t\t\t<price>" . $produce->getPrice() . "</price>\n" .
        "\t\t\t<currencyId>RUR</currencyId>\n" .
        "\t\t\t<categoryId>" . $yandexProduce->getCategory()->getId() . "</categoryId>\n" .
        "\t\t\t<picture>" . $picture . "</picture>\n" .
        "\t\t\t<typePrefix>" . stripslashes(htmlspecialchars(html_entity_decode($produce->getTitle(), ENT_QUOTES, "windows-1251"), ENT_QUOTES, "windows-1251")) . "</typePrefix>\n" .
        "\t\t\t<vendor>" . stripslashes(htmlspecialchars(html_entity_decode($produce->getVendor(), ENT_QUOTES, "windows-1251"), ENT_QUOTES, "windows-1251")) . "</vendor>\n" .
        "\t\t\t<vendorCode>" . stripslashes(htmlspecialchars(html_entity_decode($produce->getVendorLocation(), ENT_QUOTES, "windows-1251"), ENT_QUOTES, "windows-1251")) . "</vendorCode>\n" .
        "\t\t\t<model>" . stripslashes(htmlspecialchars(html_entity_decode($produce->getTitle(), ENT_QUOTES, "windows-1251"), ENT_QUOTES, "windows-1251")) . "</model>\n" .
        "\t\t\t<description>" . stripslashes(htmlspecialchars(html_entity_decode($description, ENT_QUOTES, "windows-1251"), ENT_QUOTES, "windows-1251")) . "</description>\n" .
        "\t\t</offer>\n\n";
    fwrite($fp, $offer);
}

$offerFoot = "\t</offers>\n\n";
fwrite($fp, $offerFoot);

$foot = "</shop>\n" .
    "</yml_catalog>\n";
fwrite($fp, $foot);

fclose($fp);

$viewList = Array();
$viewList[] = new SimpleTextView("<DIV class='switch font17 color2' style='padding:0 0 10px 0px'>Яндекс каталог</DIV>");
$viewList[] = new SimpleTextView("<DIV class='switch font13' style='color:green;'>Каталог успешно выгружен</DIV>");

$view = new ControlMainView($permissionController);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";

