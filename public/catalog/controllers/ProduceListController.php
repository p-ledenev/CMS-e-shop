<?

/* @property ProducePartition $partition */
class ProduceListController extends Controller
{
    protected $partition;
    protected $page;

    public function __construct(&$request, $partition, $page = null)
    {
        parent::__construct($request);

        $this->partition = $partition;
        $this->page = $page;
    }

    /* @return View */
    protected function processOnController()
    {
        $filter = new ProduceFilter($this->partition->getUrl(), $this->partition->getCategory(), $this->partition, null, true);
        $filter->getNavigation()->setInitialPerPage($filter->countItemList());
        $filter->getNavigation()->resetAll();

        if ($this->page)
            $filter->getNavigation()->toPage($_GET['page']);

        if ($this->page == "all")
            $filter->getNavigation()->allPages();

        if ($this->page == "nav")
            $filter->getNavigation()->resetAll();

        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = ViewFactory::createHeadCarouselForTop();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-top-width:1px;' class='bordercolor_lightgray'/>");
        //$viewList[] = new NavigationView($filter->getNavigation());
        $viewList[] = new ProducePartitionView($filter, Constants::$cartResultId, Constants::$inflowResultId);
        $viewList[] = new SimpleTextView("<DIV style='padding:20px 0 0 0;'/>");
        $viewList[] = ViewFactory::createBottomCarouselForNewestCategoryPartition($this->partition->getCategory(), $this->partition);
        $viewList[] = new SimpleTextView("</DIV>");

        $headViewList = Array();
        $headViewList[] = new AJAXResultView(Constants::$cartResultId);
        $headViewList[] = new AJAXResultView(Constants::$inflowResultId);

        $view = new MainView($this->request, $this->partition->getCategory());

        $view->setViewList($viewList);
        $view->setHeadViewList($headViewList);

        return $view;
    }
}

;