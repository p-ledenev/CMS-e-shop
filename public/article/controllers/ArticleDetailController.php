<?

/* @property Article $article
 * @property Partition $partition
 * @property Captcha $captcha
 */
class ArticleDetailController extends Controller
{
    protected $partition;
    protected $article;
    protected $captcha;
    protected $cdata;

    public function __construct(&$request, $article, $partition, &$captcha, $cdata)
    {
        parent::__construct($request);

        $this->article = $article;
        $this->partition = $partition;
        $this->captcha = $captcha;
        $this->cdata = $cdata;
    }

    /* @return View */
    protected function processOnController()
    {
        /* @var Comment $comment */
        $comment = ArticleComment::initEntity("ArticleComment");
        $comment->fillEntityBy($this->cdata);
        $comment->setItem($this->article);

        $strErr = $this->processAction($comment);

        $viewList = Array();

        $viewList[] = new SimpleTextView("<DIV style='border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new ArticleDetailView($this->article, $comment, $this->captcha, $this->getCart(), $this->partition);
        $viewList[] = new SimpleTextView("<DIV style='padding:20px 20px 0 40px; border-top-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = ArticleListSquareView::createFor($this->partition, $this->article);
        $viewList[] = new SimpleTextView("</DIV>");
        $viewList[] = new SimpleTextView("</DIV>");

        $view = new MainView($this->request, $this->partition->getCategory(), $strErr);

        $view->setViewList($viewList);

        return $view;
    }

    /* @param Comment $comment */
    protected function processAction($comment)
    {
        if (!$this->cdata['rec'])
            return "";

        if (!$this->captcha->validate($this->cdata['validate']))
            return "Неверно введен код подтверждения";

        try {
            $comment->setNewId();
            $comment->persistEntitySafly();

            $comment->setComment("");

        } catch (Exception $e) {

            return "Невозможно сохранить информацию. Обратитесь к администратраторам магазина";
        }
    }
}

;

