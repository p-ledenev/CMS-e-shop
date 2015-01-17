<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 08.08.13
 * Time: 0:00
 * To change this template use File | Settings | File Templates.
 */

/* @property Customer $customer
 * @property Paymethod $paymethod
 * @property DealStatus $status
 * @property Address $address
 * @property DealProduce[] $produceList
 * @property DealProduce[] $giftList
 */
class Deal extends PersistableEntity
{
    protected $thedate;
    protected $orderNo;
    protected $status;
    protected $customer;
    protected $address;
    protected $paymethod;
    protected $amount;
    protected $amountTotal;
    protected $amountDeclared;
    protected $amountWithDiscont;
    protected $amountInAccomulate;
    protected $discontPercent;
    protected $gift;
    protected $deliveryTime;
    protected $webSite;
    protected $referer;
    protected $deposit;
    protected $coupon;
    protected $couponNumber;
    protected $postId;
    protected $postDate;
    protected $postInvoice;
    protected $transportCompany;
    protected $isPackage;
    protected $adminComment;

    private $produceList;
    private $giftList;

    public function __construct()
    {
        parent::__construct();

        $this->giftList = Array();
    }

    /* @param Cart $cart */
    public static function createFrom($cart, $customer, $address)
    {
        /* @var Deal $deal */
        $deal = PersistableEntity::initEntityWithNewId("Deal");
        $deal->setCustomer($customer);
        $deal->setAddress($address);
        $deal->thedate = mktime();

        $deal->fillBy($cart);

        return $deal;
    }

    public function setAdminComment($adminComment)
    {
        $this->adminComment = $adminComment;
    }

    public function getAdminComment()
    {
        return $this->getValueFor("adminComment");
    }

    public function setAmountDeclared($amountDeclared)
    {
        $this->amountDeclared = $amountDeclared;
    }

    public function getAmountDeclared()
    {
        return $this->getValueFor("amountDeclared");
    }

    public function setTransportCompany($transportCompany)
    {
        $this->transportCompany = $transportCompany;
    }

    public function getTransportCompany()
    {
        return $this->getValueFor("transportCompany");
    }

    public function setIsPackage($isPackage)
    {
        $this->isPackage = $isPackage;
    }

    public function getIsPackage()
    {
        return $this->getValueFor("isPackage");
    }

    public function setGiftList($giftList)
    {
        $this->giftList = $giftList;
    }

    public function getGiftList()
    {
        return $this->giftList;
    }

    public function setOrderNo($orderNo)
    {
        $this->orderNo = $orderNo;
    }

    public function getOrderNo()
    {
        return $this->getValueFor("orderNo");
    }

    public function setPostInvoice($postInvoice)
    {
        $this->postInvoice = $postInvoice;
    }

    public function getPostInvoice()
    {
        return $this->getValueFor("postInvoice");
    }

    public function setAmountTotal($amountTotal)
    {
        $this->amountTotal = $amountTotal;
    }

    public function getAmountTotal()
    {
        return $this->getValueFor("amountTotal");
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getPostId()
    {
        return $this->getValueFor("postId");
    }

    public function setCoupon($coupon)
    {
        $this->coupon = $coupon;
    }

    public function getCoupon()
    {
        return $this->getValueFor("coupon");
    }

    public function setCouponNumber($couponNumber)
    {
        $this->couponNumber = $couponNumber;
    }

    public function getCouponNumber()
    {
        return $this->getValueFor("couponNumber");
    }

    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;
    }

    public function getDeposit()
    {
        return $this->getValueFor("deposit");
    }

    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
    }

    public function getPostDate()
    {
        return $this->getValueFor("postDate");
    }

    /* @param DealProduce[] $produceList */
    public function setProduceList($produceList)
    {
        foreach ($produceList as $produce)
            $produce->setDeal($this);

        $this->produceList = $produceList;
    }

    public function getProduceList()
    {
        if ($this->produceList)
            return $this->produceList;

        $arrItems = $this->select("SELECT produce, amount, price, discont_percent, in_accomulate
                                         FROM deal_produce WHERE deal=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item) {
            $produce = new DealProduce(Produce::initEntityWithId("Produce", $item['produce']), $this);
            $produce->initEntityById();
            $items[] = $produce;
        }
        $this->produceList = $items;

        return $this->produceList;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    /* @return Address */
    public function getAddress()
    {
        return $this->getValueFor("address");
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->getValueFor("amount");
    }

    public function setAmountInAccomulate($amountInAccomulate)
    {
        $this->amountInAccomulate = $amountInAccomulate;
    }

    public function getAmountInAccomulate()
    {
        return $this->getValueFor("amountInAccomulate");
    }

    public function setAmountWithDiscont($amountWithDiscont)
    {
        $this->amountWithDiscont = $amountWithDiscont;
    }

    public function getAmountWithDiscont()
    {
        return $this->getValueFor("amountWithDiscont");
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /* @return Customer */
    public function getCustomer()
    {
        return $this->getValueFor("customer");
    }

    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
    }

    public function getDeliveryTime()
    {
        return $this->getValueFor("deliveryTime");
    }

    public function setDiscontPercent($discontPercent)
    {
        $this->discontPercent = $discontPercent;
    }

    public function getDiscontPercent()
    {
        return $this->getValueFor("discontPercent");
    }

    public function setGift($gift)
    {
        $this->gift = $gift;
    }

    public function getGift()
    {
        return $this->getValueFor("gift");
    }

    public function setPaymethod($paymethod)
    {
        $this->paymethod = $paymethod;
    }

    /* @return Paymethod */
    public function getPaymethod()
    {
        return $this->getValueFor("paymethod");
    }

    public function setReferer($referer)
    {
        $this->referer = $referer;
    }

    public function getReferer()
    {
        return $this->getValueFor("referer");
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /* @return DealStatus */
    public function getStatus()
    {
        return $this->getValueFor("status");
    }

    public function setThedate($thedate)
    {
        $this->thedate = $thedate;
    }

    public function getThedate()
    {
        return $this->getValueFor("thedate");
    }

    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;
    }

    public function getWebSite()
    {
        return $this->getValueFor("webSite");
    }

    public function persistEntity()
    {
        $this->setGiftByGiftList();

        $this->execute("INSERT INTO deal (id, thedate, status, customer, address, paymethod, amount, amount_total,
        amount_with_discont,amount_in_accomulate, discont_percent, gift, delivery_time, website, referer, admin_comment,
        post_date, post_id, post_invoice, coupon, coupon_number, deposit, amount_declared, transport_company, is_package) VALUES ("
            . $this->id . ", '"
            . $this->thedate . "', '"
            . $this->status->getCode() . "', '"
            . $this->customer->getId() . "', '"
            . $this->address->getId() . "', '"
            . $this->paymethod->getCode() . "', '"
            . $this->amount . "', '"
            . $this->amountTotal . "', '"
            . $this->amountWithDiscont . "', '"
            . $this->amountInAccomulate . "', '"
            . $this->getSQLValueFor("discontPercent") . "', '"
            . $this->getSQLValueFor("gift") . "', '"
            . $this->getSQLValueFor("deliveryTime") . "', '"
            . $this->getSQLValueFor("webSite") . "', '"
            . $this->getSQLValueFor("referer") . "', '"
            . $this->getSQLValueFor("adminComment") . "', '"
            . $this->getSQLValueFor("postDate") . "', '"
            . $this->getSQLValueFor("postId") . "', '"
            . $this->getSQLValueFor("postInvoice") . "', '"
            . $this->getSQLValueFor("coupon") . "', '"
            . $this->getSQLValueFor("couponNumber") . "', '"
            . $this->getSQLValueFor("deposit") . "', '"
            . $this->getSQLValueFor("amountDeclared") . "', '"
            . $this->getSQLValueFor("transportCompany") . "', '"
            . ($this->isPackage == true ? "1" : "0") . "')"
        );

        $this->replaceDealProduces();
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->setPostedValueFor("thedate", $arItem['thedate']);

        if (isset($arItem['status']))
            $this->status = DealStatus::getItemBy($arItem['status'], "DealStatus");

        if (isset($arItem['customer']))
            $this->customer = Customer::initEntityWithId("Customer", $arItem['customer']);

        if (isset($arItem['address']))
            $this->address = Address::initEntityWithId("Address", $arItem['address']);

        if (isset($arItem['paymethod']))
            $this->paymethod = Paymethod::getItemBy($arItem['paymethod'], "Paymethod");

        if (is_numeric($arItem['post_date']) !== true)
            $arItem['post_date'] = strtotime($arItem['post_date']);

        $this->setPostedValueFor("amount", $arItem['amount']);
        $this->setPostedValueFor("orderNo", $arItem['order_no']);
        $this->setPostedValueFor("amountTotal", $arItem['amount_total']);
        $this->setPostedValueFor("amountDeclared", $arItem['amount_declared']);
        $this->setPostedValueFor("amountWithDiscont", $arItem['amount_with_discont']);
        $this->setPostedValueFor("amountInAccomulate", $arItem['amount_in_accomulate']);
        $this->setPostedValueFor("discontPercent", $arItem['discont_percent']);
        $this->setPostedValueFor("gift", $arItem['gift']);
        $this->setPostedValueFor("deliveryTime", $arItem['delivery_time']);
        $this->setPostedValueFor("webSite", $arItem['website']);
        $this->setPostedValueFor("referer", $arItem['referer']);
        $this->setPostedValueFor("adminComment", $arItem['admin_comment']);
        $this->setPostedValueFor("postDate", $arItem['post_date']);
        $this->setPostedValueFor("postId", $arItem['post_id']);
        $this->setPostedValueFor("postInvoice", $arItem['post_invoice']);
        $this->setPostedValueFor("coupon", $arItem['coupon']);
        $this->setPostedValueFor("couponNumber", $arItem['coupon_number']);
        $this->setPostedValueFor("deposit", $arItem['deposit']);
        $this->setPostedValueFor("transportCompany", $arItem['transport_company']);
        $this->isPackage = ($arItem['is_package'] == "1") ? true : false;

        if ($arItem['produces']) {
            $this->produceList = Array();
            foreach ($arItem['produces'] as $arProduce) {
                $produce = new DealProduce(Produce::initEntityWithId("Produce", $arProduce['id']), $this);
                $produce->fillEntityBy($arProduce);
                $this->produceList[] = $produce;
            }
        }
    }

    public function updateEntity()
    {
        $this->setGiftByGiftList();

        $this->execute("UPDATE deal SET"
            . " thedate='" . $this->thedate
            . "', status='" . $this->status->getCode()
            . "', customer='" . $this->customer->getId()
            . "', address='" . $this->address->getId()
            . "', paymethod='" . $this->paymethod->getCode()
            . "', amount='" . $this->amount
            . "', amount_total='" . $this->getSQLValueFor("amountTotal")
            . "', amount_with_discont='" . $this->amountWithDiscont
            . "', amount_in_accomulate='" . $this->amountInAccomulate
            . "', discont_percent='" . $this->getSQLValueFor("discontPercent")
            . "', gift='" . $this->getSQLValueFor("gift")
            . "', delivery_time='" . $this->getSQLValueFor("deliveryTime")
            . "', website='" . $this->getSQLValueFor("webSite")
            . "', referer='" . $this->getSQLValueFor("referer")
            . "', admin_comment='" . $this->getSQLValueFor("adminComment")
            . "', post_date='" . $this->getSQLValueFor("postDate")
            . "', post_id='" . $this->getSQLValueFor("postId")
            . "', post_invoice='" . $this->getSQLValueFor("postInvoice")
            . "', coupon='" . $this->getSQLValueFor("coupon")
            . "', coupon_number='" . $this->getSQLValueFor("couponNumber")
            . "', deposit='" . $this->getSQLValueFor("deposit")
            . "', amount_declared='" . $this->getSQLValueFor("amountDeclared")
            . "', transport_company='" . $this->getSQLValueFor("transportCompany")
            . "', is_package='" . ($this->isPackage == true ? "1" : "0")
            . "' WHERE id = " . $this->id);

        $this->replaceDealProduces();
    }

    public function updateStatus()
    {
        echo $this->execute("UPDATE deal SET status='" . $this->status->getCode() . "' WHERE id='" . $this->id . "'");
    }

    public function reCountAmounts()
    {
        $this->amount = 0;
        $this->amountInAccomulate = 0;
        $this->amountWithDiscont = 0;

        foreach ($this->produceList as $produce) {
            $amount = $produce->getPrice() * $produce->getAmount();

            $this->amount += $amount;

            if ($produce->getInAccomulate() == true)
                $this->amountInAccomulate += $amount * (1 - 0.01 * $produce->getDiscontPercent());

            $this->amountWithDiscont += $amount * (1 - 0.01 * $produce->getDiscontPercent());
        }
    }

    /* @param DealProduce $produce
     * @param DiscontStrategy $strategy
     */
    public function addProduce($produce, $strategy)
    {
        $strategy->applayToProduce($produce);
        $this->produceList[] = $produce;
        $this->reCountAmounts();
    }

    /* @param Cart $cart */
    public function fillBy($cart)
    {
        $this->setProduceList($cart->getProduceList());
        $cart->getDiscontStrategy()->applayTo($this);
        $this->reCountAmounts();
    }

    /* @param DealProduce $produce */
    public function addGiftProduce($produce)
    {
        $this->giftList[] = $produce;
    }

    /* @param Produce $produce */
    public function getProduceBy($produce)
    {
        foreach ($this->produceList as $dealProduce)
            if ($dealProduce->getProduce()->equals($produce))
                return $dealProduce;

        return null;
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM deal WHERE id=" . $this->id);

        $this->removeDealProduces();
    }

    protected function getRemoveImossibilityReason()
    {
        return "";
    }

    public function toShortString()
    {
        return $this->getId();
    }

    public function toDetailString()
    {
        return $this->getId();
    }

    private function removeDealProduces()
    {
        foreach ($this->produceList as $produce)
            $produce->removeEntitySafly();
    }

    public function replaceDealProduces()
    {
        $this->removeDealProduces();

        foreach ($this->produceList as $produce) {
            $produce->persistEntitySafly();
        }
    }

    public function getPersistTableName()
    {
        return "deal";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("thedate");
        $response .= $this->isEmptyValueFor("customer");
        $response .= $this->isEmptyValueFor("status");
        $response .= $this->isEmptyValueFor("address");
        $response .= $this->isEmptyValueFor("paymethod");
        $response .= $this->isEmptyValueFor("amount");
        $response .= $this->isEmptyValueFor("amountWithDiscont");
        $response .= $this->isEmptyValueFor("amountInAccomulate");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setProduceList(null);
        $this->getProduceList();
    }

    public function setGiftByGiftList()
    {
        if (count($this->getGiftList()) <= 0)
            return;

        $this->gift = "";
        foreach ($this->getGiftList() as $gift) {
            $qnt = ($gift->getAmount() > 1) ? " " . $gift->getAmount() . " רע." : "";
            $this->gift .= $gift->getProduce()->getTitle() . $qnt . "; ";
        }
    }

    public function isEmptyProduceList()
    {
        return count($this->produceList) > 0 ? false : true;
    }

    public function isEmptyGiftList()
    {
        return count($this->giftList) > 0 ? false : true;
    }

    public function isSetCustomer()
    {
        return ($this->customer && $this->customer->getId() > 0) ? true : false;
    }

    public function isSetAddress()
    {
        return ($this->address && $this->address->getId() > 0) ? true : false;
    }

    public function clear()
    {
        $this->id = -2;
        $this->customer = null;
        $this->produceList = Array();
        $this->paymethod = null;
        $this->status = null;
        $this->address = null;
        $this->giftList = Array();
        $this->gift = null;
        $this->amount = null;
        $this->amountWithDiscont = null;
        $this->amountInAccomulate = null;
        $this->amountTotal = null;
        $this->coupon = null;
        $this->couponNumber = null;
        $this->deliveryTime = null;
        $this->deposit = null;
        $this->discontPercent = null;
        $this->orderNo = null;
        $this->postDate = null;
        $this->postId = null;
        $this->postInvoice = null;
        $this->referer = null;
        $this->thedate = null;
        $this->webSite = null;
        $this->loaded = false;
    }
}