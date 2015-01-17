<?
include $_SERVER['DOCUMENT_ROOT'] . "/control/prolog.php";

$filter = unserialize($_SESSION['articleFilter']);

/* @var Article $article */
$article = Article::initEntity("Article");

if ($_GET['delete'] == "yes" && $_GET['article_id']) {
    $article->setId($_GET['article_id']);

    try {
        $article->removeEntitySafly();
    } catch (Exception $e) {
        $strErr = $e->getMessage();
    }
}

if ($_REQUEST['tres'])
    unset($filter);

if (!$filter)
    $filter = new ArticleFilter("control/articles", Category::initEntityWithId("Category", 17958),
        ArticlePartition::initEntityWithId("ArticlePartition", 17960));

if ($_POST['tser'])
    $filter->setFilter($_POST);

if ($_GET['page'])
    $filter->getNavigation()->toPage($_GET['page']);

if ($_GET['page'] == "all")
    $filter->getNavigation()->allPages();

if ($_GET['page'] == "nav")
    $filter->getNavigation()->resetAll();

$_SESSION['articleFilter'] = serialize($filter);

$articleList = $filter->loadItemList("Article");

$viewList = Array();
$viewList[] = new ArticleFilterView($filter);
$viewList[] = new NavigationView($filter->getNavigation());
$viewList[] = new ArticleListTableView($articleList, "/control/articles");
$viewList[] = $viewList[1];

$view = new ControlMainView($permissionController, $strErr);
$view->setViewList($viewList);

$view->view();

include $_SERVER['DOCUMENT_ROOT'] . "/control/epilog.php";

