<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 22.04.14
 * Time: 8:55
 */
class UnsubscribeController extends Controller
{
    protected $confirmCode;

    public function __construct(&$request, $confirmCode)
    {
        parent::__construct($request);

        $this->confirmCode = $confirmCode;
    }


    /* @return View */
    protected function processOnController()
    {
        $this->processAction();

        $viewList = Array();
        $viewList[] = new SimpleTextView("<div style='font-size:16px;' class='color_marsh'>Ваша подписка успешно удалена</div>");

        $view = new MainView($this->request);
        $view->setViewList($viewList);

        return $view;
    }

    protected function processAction()
    {
        try {
            $filter = new SubscriptionFilter("/", null, null, $this->confirmCode);
            $items = $filter->loadItemList("SubscriptionItem");

            /* @var PersistableEntity $item */
            foreach ($items as $item)
                $item->removeEntitySafly();

        } catch (Exception $e) {
            //echo $e->getMessage();
        }
    }
}