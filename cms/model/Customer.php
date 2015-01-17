<?php
/**
 * Created by JetBrains PhpStorm.
 * User: di
 * Date: 07.08.13
 * Time: 23:03
 * To change this template use File | Settings | File Templates.
 */

/* @property Address[] $addressList
 * @property Usergroup[] $groupList
 * @property Deal[] $dealList
 * @property PollReport[] $reportList
 */
class Customer extends SubscriberEntity
{
    protected $login;
    protected $password;
    protected $checkword;
    protected $discontPercent;
    protected $distributon;
    protected $inMailing;
    protected $deposit;
    protected $postFirstName;
    protected $postSecondName;
    protected $postMiddleName;
    protected $adminComment;
    protected $hash;

    protected $addressList;
    protected $groupList;
    protected $dealList;
    protected $reportList;

    protected $isCalled;
    protected $isWelcomeLetter;
    protected $isFirstDealLetter;
    protected $isFirstDealSMS;
    protected $isBirthdayPresent;
    protected $isAnniversaryCoupon;

    protected $isNewCustomer;

    public function setAdminComment($adminComment)
    {
        $this->adminComment = $adminComment;
    }

    public function getAdminComment()
    {
        return $this->getValueFor("adminComment");
    }

    public function setReportList($reportList)
    {
        $this->reportList = $reportList;
    }

    public function getReportList()
    {
        if ($this->reportList)
            return $this->reportList;

        $arItems = $this->select("SELECT id FROM poll_report WHERE customer=" . $this->id . " ORDER BY question");

        $items = Array();
        foreach ($arItems as $arItem)
            $items[] = PollReport::initEntityWithId("PollReport", $arItem['id']);

        $this->reportList = $items;

        return $this->reportList;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function getHash()
    {
        return $this->getValueFor("hash");
    }

    public function setIsAnniversaryCoupon($isAnniversaryCoupon)
    {
        $this->isAnniversaryCoupon = $isAnniversaryCoupon;
    }

    public function getIsAnniversaryCoupon()
    {
        return $this->getValueFor("isAnniversaryCoupon");
    }

    public function setIsBirthdayPresent($isBirthdayPresent)
    {
        $this->isBirthdayPresent = $isBirthdayPresent;
    }

    public function getIsBirthdayPresent()
    {
        return $this->getValueFor("isBirthdayPresent");
    }

    public function setIsCalled($isCalled)
    {
        $this->isCalled = $isCalled;
    }

    public function getIsCalled()
    {
        return $this->getValueFor("isCalled");
    }

    public function setIsFirstDealLetter($isFirstDealLetter)
    {
        $this->isFirstDealLetter = $isFirstDealLetter;
    }

    public function getIsFirstDealLetter()
    {
        return $this->getValueFor("isFirstDealLetter");
    }

    public function setIsFirstDealSMS($isFirstDealSMS)
    {
        $this->isFirstDealSMS = $isFirstDealSMS;
    }

    public function getIsFirstDealSMS()
    {
        return $this->getValueFor("isFirstDealSMS");
    }

    public function setIsWelcomeLetter($isWelcomeLetter)
    {
        $this->isWelcomeLetter = $isWelcomeLetter;
    }

    public function getIsWelcomeLetter()
    {
        return $this->getValueFor("isWelcomeLetter");
    }

    public function setIsNewCustomer($isNewCustomer)
    {
        $this->isNewCustomer = $isNewCustomer;
    }

    public function getIsNewCustomer()
    {
        return $this->getValueFor("isNewCustomer");
    }

    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;
    }

    public function getDeposit()
    {
        return $this->getValueFor("deposit");
    }

    public function setDealList($dealList)
    {
        $this->dealList = $dealList;
    }

    public function getDealList()
    {
        if ($this->dealList)
            return $this->dealList;

        $arItems = $this->select("SELECT id FROM deal WHERE customer=" . $this->id . " ORDER BY thedate DESC");

        $items = Array();
        foreach ($arItems as $arItem)
            $items[] = Deal::initEntityWithId("Deal", $arItem['id']);

        $this->dealList = $items;

        return $this->dealList;
    }

    public function setAddressList($addressList)
    {
        $this->addressList = $addressList;
    }

    public function getAddressList()
    {
        if ($this->addressList)
            return $this->addressList;

        $arItems = $this->select("SELECT id FROM user_address WHERE customer=" . $this->id);

        $items = Array();
        foreach ($arItems as $arItem)
            $items[] = Address::initEntityWithId("Address", $arItem['id']);

        $this->addressList = $items;

        return $this->addressList;
    }

    public function setPostFirstName($postFirstName)
    {
        $this->postFirstName = $postFirstName;
    }

    public function getPostFirstName()
    {
        return $this->getValueFor("postFirstName");
    }

    public function setPostSecondName($postSecondName)
    {
        $this->postSecondName = $postSecondName;
    }

    public function getPostSecondName()
    {
        return $this->getValueFor("postSecondName");
    }

    public function setPostMiddleName($postMiddleName)
    {
        $this->postMiddleName = $postMiddleName;
    }

    public function getPostMiddleName()
    {
        return $this->getValueFor("postMiddleName");
    }

    public function setCheckword($checkword)
    {
        $this->checkword = $checkword;
    }

    public function getCheckword()
    {
        return $this->getValueFor("checkword");
    }

    public function setDiscontPercent($discontPercent)
    {
        $this->discontPercent = $discontPercent;
    }

    public function getDiscontPercent()
    {
        return $this->discontPercent;
    }

    public function setDistributon($distributon)
    {
        $this->distributon = $distributon;
    }

    public function getDistributon()
    {
        return $this->getValueFor("distribution");
    }

    public function setGroupList($groupList)
    {
        $this->groupList = $groupList;
    }

    public function getGroupList()
    {
        if ($this->groupList)
            return $this->groupList;

        $arItems = $this->select("SELECT ugroup FROM user_usergroup WHERE user=" . $this->id);

        $items = Array();
        foreach ($arItems as $arItem)
            $items[] = Usergroup::initEntityWithId("Usergroup", $arItem['ugroup']);

        $this->groupList = $items;

        return $this->addressList;
    }

    public function setInMailing($inMailing)
    {
        $this->inMailing = $inMailing;
    }

    public function getInMailing()
    {
        return $this->getValueFor("inMailing");
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getLogin()
    {
        return $this->getValueFor("login");
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->getValueFor("password");
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO user (id, name, email, login, passwd, chword, phone, hash,
        discont_percent, deposit, distribution, in_mailing, post_fname, post_sname, post_mname, admin_comment,
        date_create, is_called, is_welcome_letter, is_first_deal_letter, is_first_deal_sms, is_birthday_present,
        is_anniversary_coupon) VALUES ("
            . $this->id . ", '"
            . $this->getSQLValueFor("name") . "', '"
            . $this->getSQLValueFor("email") . "', '"
            . $this->getSQLValueFor("login") . "', '"
            . $this->password . "', '"
            . $this->checkword . "', '"
            . $this->getSQLValueFor("phone") . "', '"
            . $this->getSQLValueFor("hash") . "', '"
            . $this->getSQLValueFor("discontPercent") . "', '"
            . $this->getSQLValueFor("deposit") . "', '"
            . $this->getSQLValueFor("distribution") . "', '"
            . (($this->inMailing) ? "1" : "0") . "', '"
            . $this->getSQLValueFor("postFirstName") . "', '"
            . $this->getSQLValueFor("postSecondName") . "', '"
            . $this->getSQLValueFor("postMiddleName") . "', '"
            . $this->getSQLValueFor("adminComment") . "', '"
            . $this->getSQLValueFor("dateCreate") . "', '"
            . (($this->isCalled) ? "1" : "0") . "', '"
            . (($this->isWelcomeLetter) ? "1" : "0") . "', '"
            . (($this->isFirstDealLetter) ? "1" : "0") . "', '"
            . (($this->isFirstDealSMS) ? "1" : "0") . "', '"
            . (($this->isBirthdayPresent) ? "1" : "0") . "', '"
            . (($this->isAnniversaryCoupon) ? "1" : "0") .
            "')");
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        $this->inMailing = ($arItem['in_mailing'] > 0) ? true : false;
        $this->isCalled = ($arItem['is_called'] > 0) ? true : false;
        $this->isFirstDealLetter = ($arItem['is_first_deal_letter'] > 0) ? true : false;
        $this->isWelcomeLetter = ($arItem['is_welcome_letter'] > 0) ? true : false;
        $this->isFirstDealSMS = ($arItem['is_first_deal_sms'] > 0) ? true : false;
        $this->isBirthdayPresent = ($arItem['is_birthday_present'] > 0) ? true : false;
        $this->isAnniversaryCoupon = ($arItem['is_anniversary_coupon'] > 0) ? true : false;

        $this->setPostedValueFor("name", $arItem['name']);
        $this->setPostedValueFor("email", $arItem['email']);
        $this->setPostedValueFor("login", $arItem['login']);
        $this->setPostedValueFor("password", $arItem['passwd']);
        $this->setPostedValueFor("checkword", $arItem['chword']);
        $this->setPostedValueFor("phone", $arItem['phone']);
        $this->setPostedValueFor("hash", $arItem['hash']);
        $this->setPostedValueFor("distribuiton", $arItem['distribuiton']);
        $this->setPostedValueFor("discontPercent", $arItem['discont_percent']);
        $this->setPostedValueFor("deposit", $arItem['deposit']);
        $this->setPostedValueFor("postFirstName", $arItem['post_fname']);
        $this->setPostedValueFor("postSecondName", $arItem['post_sname']);
        $this->setPostedValueFor("postMiddleName", $arItem['post_mname']);
        $this->setPostedValueFor("adminComment", $arItem['admin_comment']);

        $this->dateCreate = time();
        $this->setPostedValueFor("date_create", $arItem['date_create']);
    }

    public function updateEntity()
    {
        $this->execute("UPDATE user SET"
            . " name='" . $this->getSQLValueFor("name")
            . "', email='" . $this->getSQLValueFor("email")
            . "', login='" . $this->getSQLValueFor("login")
            . "', passwd='" . $this->password
            . "', chword='" . $this->checkword
            . "', phone='" . $this->getSQLValueFor("phone")
            . "', hash='" . $this->getSQLValueFor("hash")
            . "', discont_percent='" . $this->getSQLValueFor("discontPercent")
            . "', deposit='" . $this->getSQLValueFor("deposit")
            . "', distribution='" . $this->getSQLValueFor("distribution")
            . "', in_mailing='" . (($this->inMailing) ? "1" : "0")
            . "', post_fname='" . $this->getSQLValueFor("postFirstName")
            . "', post_sname='" . $this->getSQLValueFor("postSecondName")
            . "', post_mname='" . $this->getSQLValueFor("postMiddleName")
            . "', admin_comment='" . $this->getSQLValueFor("adminComment")
            . "', is_called='" . (($this->isCalled) ? "1" : "0")
            . "', is_welcome_letter='" . (($this->isWelcomeLetter) ? "1" : "0")
            . "', is_first_deal_letter='" . (($this->isFirstDealLetter) ? "1" : "0")
            . "', is_first_deal_sms='" . (($this->isFirstDealSMS) ? "1" : "0")
            . "', is_birthday_present='" . (($this->isBirthdayPresent) ? "1" : "0")
            . "', is_anniversary_coupon='" . (($this->isAnniversaryCoupon) ? "1" : "0")
            . "' WHERE id = " . $this->id);
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM user WHERE id=" . $this->id);

        foreach ($this->addressList as $address)
            $address->removeEntity();

        foreach ($this->reportList as $report)
            $report->removeEntity();

        $this->removeUsergroups();
    }

    protected function getRemoveImossibilityReason()
    {
        $response = parent::getRemoveImossibilityReason();

        $response .= $this->printList($this->getDealList(), "Customer refered by deals: ");

        return $response;
    }

    public function countTotalDeals()
    {
        return count($this->getDealList());
    }

    public function countRejectDeals()
    {
        $count = 0;
        foreach ($this->getDealList() as $deal)
            if ($deal->getStatus()->equals(DealStatus::$reject))
                $count++;

        return $count;
    }

    public function countTotalDealsWithoutReject()
    {
        $count = 0;
        foreach ($this->dealList as $deal)
            if ($deal->getStatus()->equals(DealStatus::$reject))
                $count++;

        return $count;
    }

    public function toShortString()
    {
        return $this->getName();
    }

    public function toDetailString()
    {
        return $this->getName();
    }

    protected function removeUsergroups()
    {
        $this->execute("DELETE FROM user_usergroup WHERE user=" . $this->id);
    }

    public function calculateDealListPurchaseWithDiscont()
    {
        $amount = 0;
        foreach ($this->getDealList() as $deal)
            $amount += $deal->getAmountWithDiscont();

        return $amount;
    }

    public function calculateDealListPurchase()
    {
        $purchase = 0;
        foreach ($this->getDealList() as $deal)
            if (!$deal->getStatus()->equals(DealStatus::$reject))
                $purchase += $deal->getAmount();

        return $purchase;
    }

    public function calculateDealListPurchaseInAccomulate()
    {
        $purchase = 0;
        foreach ($this->getDealList() as $deal)
            if (!$deal->getStatus()->equals(DealStatus::$reject))
                $purchase += $deal->getAmountInAccomulate();

        return $purchase;
    }

    public function getPersistTableName()
    {
        return "user";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->getUpdateImposibilityReason();

        if ($this->isPersistedWithEmail())
            $response .= "Email allready registered";

        return $response;
    }

    protected function getUpdateImposibilityReason()
    {
        $response = $this->isEmptyValueFor("name");
        $response .= $this->isEmptyValueFor("email");

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        parent::initEntityReferencesByIdFromDB();

        $this->setAddressList(null);
        $this->setGroupList(null);
        $this->setDealList(null);

        $this->getAddressList();
        $this->getGroupList();
        $this->getDealList();
    }

    public function changePasswordTo($newPassword)
    {
        $this->setPassword(md5($newPassword));
        $this->generateCheckword();
        $this->calculateHash();

        $this->updateEntitySafly();
    }

    public function validateAuthorizationByEmail($password)
    {
        $arItem = $this->select("SELECT id FROM user WHERE email='" . $this->email . "' AND passwd='" . md5($password) . "'");

        if (count($arItem) != 1)
            return false;

        $this->id = $arItem[0]['id'];
        $this->initEntityById();
        $this->generateCheckword();
        $this->calculateHash();

        $this->updateEntitySafly();

        return true;
    }

    public function validateAuthorizationByHash($hash)
    {
        if (!$hash || strlen(trim($hash)) <= 0)
            return false;

        $arItem = $this->select("SELECT id FROM user WHERE hash='" . $hash . "'");

        if (count($arItem) != 1)
            return false;

        $this->id = $arItem[0]['id'];
        $this->initEntityById();

        return true;
    }

    public function prepareNewCustomerWith($password)
    {
        $this->setNewId();
        $this->hashPassword($password);
        $this->setDateCreate(time());
        $this->generateCheckword();
        $this->calculateHash();
    }

    public function calculateHash()
    {
        $this->hash = md5(sha1($this->email . $this->password));
    }

    public function isAuthorizedByLogin($password)
    {
        $arItem = $this->select("SELECT id FROM user WHERE login='" . $this->login . "' AND passwd='" . md5($password) . "'");

        if (count($arItem) == 1) {
            $this->id = $arItem[0]['id'];
            $this->initEntityById();

            return true;
        }

        return false;
    }

    public function initEntityByEmail()
    {
        $this->loaded = true;

        $arItem = $this->select("SELECT * FROM " . $this->getPersistTableName() . " WHERE email='" . $this->email . "'");

        $this->fillEntityByArray($arItem[0]);
    }

    public function generateRowPassword()
    {
        return $this->randString(6);
    }

    public function hashPassword($password)
    {
        $this->password = md5($password);
    }

    public function generateCheckword()
    {
        $this->checkword = $this->randString(8);
    }

    /* @return SubscriberType */
    public function getSubscriberType()
    {
        return SubscriberType::$customer;
    }
}

;