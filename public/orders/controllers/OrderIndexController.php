<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 02.09.13
 * Time: 18:15
 * To change this template use File | Settings | File Templates.
 */

/* @property Deal $deal */
class OrderIndexController extends Controller
{
    protected $deal;
    protected $action;
    protected $cdata;

    public function __construct(&$request, &$deal, $cdata)
    {
        parent::__construct($request);

        $this->deal = $deal;
        $this->cdata = $cdata;

        if ($cdata['address_id'] > 0)
            $this->action = "select_address";

        if ($cdata['a_new'] == true)
            $this->action = "add_address";
    }

    /* @return View */
    protected function processOnController()
    {
        $response = $this->processAction();

        if (!$this->getCustomer()->isPersisted())
            header("Location: http://$_SERVER[HTTP_HOST]/auth/");

        if ($this->deal->isSetCustomer() && $this->deal->isSetAddress() && !$this->deal->isEmptyProduceList())
            header("Location: http://$_SERVER[HTTP_HOST]/make/");

        $this->getCustomer()->reLoadWithReferences();

        $viewList = Array();
        $viewList[] = new SimpleTextView("<DIV style='padding:0px 0 0 0; border-width:1px;' class='bordercolor_lightgray'>");
        $viewList[] = new OrderIndexView($this->getCustomer(), $this->getCart());
        $viewList[] = new SimpleTextView("</DIV>");

        $view = new MainView($this->request, Category::initEntity("Category"), $response['strErr'], $response['strInfo']);
        $view->setViewList($viewList);

        return $view;
    }

    protected function processAction()
    {
        /* @var Address $address */
        $address = Address::initEntity("Address");
        if ($this->action == "add_address") {
            try {
                $address->setNewId();
                $address->fillEntityBy($this->cdata);
                $address->setCustomer($this->getCustomer());

                $address->persistEntitySafly();

            } catch (Exception $e) {
                $strErr = "Невозможно сохранить информацию. Обратитесь к администраторам магазина";
            }
        }

        if ($this->action == "select_address") {
            $address->setId($this->cdata['address_id']);
            $address->initEntityById();
        }

        if (strlen($strErr) <= 0) {
            $this->deal->setCustomer($this->getCustomer());
            $this->deal->setAddress($address);

            $this->getCart()->getDiscontStrategy()->setCustomer($this->getCustomer());
            $this->deal->fillBy($this->getCart());
            $this->setDealGifts();
        }

        return Array('strErr' => $strErr, 'strInfo' => "");
    }

    protected function setDealGifts()
    {
        $this->deal->setGiftList(Array());
        foreach ($this->getCart()->getGiftStrategyList() as $strategy) {

            if ($this->cdata[$strategy->getId()] > 0) {

                $arProduce = explode(";", $this->cdata[$strategy->getId()]);
                /* @var Produce $produce */
                $produce = Produce::initEntityWithId("Produce", $arProduce[0]);

                $this->deal->addGiftProduce(new DealProduce($produce, null, $produce->getPrice(), $arProduce[1]));
            }
        }
    }
}

;