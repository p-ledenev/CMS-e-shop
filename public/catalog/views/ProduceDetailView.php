<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.08.13
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce
 * @property ProducePartition $partition
 * @property Captcha $captcha
 * @property Cart $cart
 */
class ProduceDetailView extends View
{
    protected $produce;
    protected $partition;
    protected $comment;
    protected $captcha;
    protected $cart;
    protected $cartResultId;
    protected $inflowResultId;

    public function __construct($produce, $comment, $captcha, $cart, $cartResultId, $inflowResultId, $partition = null)
    {
        $this->produce = $produce;
        $this->partition = $partition;
        $this->comment = $comment;
        $this->captcha = $captcha;
        $this->cart = $cart;
        $this->cartResultId = $cartResultId;
        $this->inflowResultId = $inflowResultId;
    }

    public function setInflowResultId($inflowResultId)
    {
        $this->inflowResultId = $inflowResultId;
    }

    public function getInflowResultId()
    {
        return $this->inflowResultId;
    }

    public function setCartResultId($resultId)
    {
        $this->cartResultId = $resultId;
    }

    public function getCartResultId()
    {
        return $this->cartResultId;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    public function getPartition()
    {
        return $this->partition;
    }

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    /* @return */
    public function getProduce()
    {
        return $this->produce;
    }

    public function setCaptcha($captcha)
    {
        $this->captcha = $captcha;
    }

    public function getCaptcha()
    {
        return $this->captcha;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "produceDetailView.phtml";
    }
}