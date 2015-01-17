<?

/* @property Produce $produce
 * @property Partition $partition
 * @property Captcha $captcha
 */
class ProduceDetailController extends Controller
{
    protected $partition;
    protected $produce;
    protected $captcha;
    protected $cdata;

    public function __construct(&$request, $produce, $partition, &$captcha, $cdata)
    {
        parent::__construct($request);

        $this->produce = $produce;
        $this->partition = $partition;
        $this->captcha = $captcha;
        $this->cdata = $cdata;
    }

    /* @return View */
    protected function processOnController()
    {
        if (!$this->produce->isPresence() && !$this->produce->isWaiting())
            header("Location: http://$_SERVER[HTTP_HOST]");

        /* @var Comment $comment */
        $comment = ProduceComment::initEntity("ProduceComment");
        $comment->fillEntityBy($this->cdata);
        $comment->setItem($this->produce);

        $strErr = $this->processAction($comment);

        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new ProduceDetailView($this->produce, $comment, $this->captcha, $this->getCart(),
            Constants::$cartResultId, Constants::$inflowResultId, $this->partition);

        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0;'/>");
        $viewList[] = ViewFactory::createBottomCarouselForPartition($this->partition);
        $viewList[] = new SimpleTextView("</DIV>");

        $headViewList = Array();
        $headViewList[] = new AJAXResultView(Constants::$cartResultId);
        $headViewList[] = new AJAXResultView(Constants::$inflowResultId);

        $view = new MainView($this->request, $this->partition->getCategory(), $strErr);

        $view->setViewList($viewList);
        $view->setHeadViewList($headViewList);

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

