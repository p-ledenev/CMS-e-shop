<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.02.14
 * Time: 8:11
 */

/* @property Captcha $captcha */
class ShowCaptchaController extends Controller
{
    protected $captcha;

    public function __construct(&$request, &$captcha)
    {
        parent::__construct($request);

        $this->captcha = $captcha;
    }

    /* @return View */
    protected function processOnController()
    {
        return new ShowCaptchaView($this->captcha);
    }
}