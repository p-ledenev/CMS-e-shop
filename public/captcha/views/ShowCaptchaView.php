<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.02.14
 * Time: 8:12
 */

/* @property Captcha $captcha */
class ShowCaptchaView extends View
{
    protected $captcha;

    public function __construct($captcha)
    {
        $this->captcha = $captcha;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo $this->captcha->createImage();
    }
}