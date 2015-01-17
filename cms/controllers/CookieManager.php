<?php

/**
 * Created by PhpStorm.
 * User: dk_2
 * Date: 02.08.14
 * Time: 9:41
 */
class CookieManager
{
    /* @param Customer $customer */
    public function validateCustomerByCookie($customer)
    {
        if ($customer && $customer->getId() <= 0)
            return $customer->validateAuthorizationByHash($_COOKIE[Constants::$authorizationCookieId]);

        return false;
    }

    /* @param Customer $customer */
    public function setCusotmerCookie($customer)
    {
        setcookie(Constants::$authorizationCookieId, $customer->getHash(), time() + 60 * 60 * 24 * 3000, "/");
    }

    public function removeSubscriberItemCookies()
    {
        setcookie(Constants::$authorizationCookieId, null, -1, "/");
        setcookie(Constants::$subscriberCookieId, null, -1, "/");
    }

    /* @param Subscriber $subscriber */
    public function setSubscriberCookie($subscriber)
    {
        setcookie(Constants::$subscriberCookieId,
            base64_encode($subscriber->getId() . ":" . $subscriber->getEmail() . ":" . $subscriber->getName() . ":" . $subscriber->getPhone()),
            time() + 60 * 60 * 24 * 3000, "/");
    }

    /* @param Subscriber $subscriber */
    public function fillSubscriberByCookie($subscriber)
    {
        if (!$_COOKIE[Constants::$subscriberCookieId])
            return;

        $strValues = base64_decode($_COOKIE[Constants::$subscriberCookieId]);
        $arValues = explode(":", $strValues);

        $subscriber->setEmail($arValues[1]);
        $subscriber->setName($arValues[2]);
        $subscriber->setPhone($arValues[3]);
    }
} 