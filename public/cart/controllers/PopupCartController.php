<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 9:39
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce */
class PopupCartController extends Controller
{
    protected $action;
    protected $produce;
    protected $amount;

    public function __construct(&$request, $action, $produce, $amount)
    {
        parent::__construct($request);

        $this->produce = $produce;
        $this->action = $action;
        $this->amount = $amount;
    }

    /* @return View */
    protected function processOnController()
    {
        $amount = ($this->amount) ? $this->amount : 1;

        if ($this->action == "cartadd") {
            $this->getCart()->addItemBy($this->produce, $amount);
            $cartView = new PopupCartAddView($this->produce, $this->getCart());
        }

        if ($this->action == "cartclear") {
            $this->getCart()->clear();
            $cartView = new PopupCartClearView();
        }

        return $cartView;
    }
}

;