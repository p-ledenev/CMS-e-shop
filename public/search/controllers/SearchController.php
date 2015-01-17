<?

class SearchController extends Controller
{
    protected $cdata;

    public function __construct(&$requst, $cdata)
    {
        parent::__construct($requst);

        $this->cdata = $cdata;
    }

    /* @return View */
    protected function processOnController()
    {
        $viewList = Array();
        $viewList[] = $this->createSearchView();

        $view = new MainView($this->request);
        $view->setViewList($viewList);

        return $view;
    }

    protected function createSearchView()
    {
        $title = $this->cdata['produce_title'];

        if ($this->cdata == null)
            return new SearchView("");

        if (strlen($title) < 3)
            return new LargeSearchResultView($title);

        $filter = new ProduceSearchFilter("/", $title);
        $filter->getNavigation()->setInitialPerPage($filter->countItemList());
        $filter->getNavigation()->resetAll();

        if ($filter->countItemList() > 40)
            return new LargeSearchResultView($title);

        if ($filter->countItemList() == 0)
            return new EmptySearchResultView($title);

        return new SearchResultView($filter->loadItemList("Produce"), $title);
    }
}

;