<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 09.04.14
 * Time: 9:13
 */

class SubscriberView extends View
{
    protected $strErr;
    protected $strInfo;

    public function __construct($strErr, $strInfo)
    {
        $this->strErr = $strErr;
        $this->strInfo = $strInfo;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $strErr = $this->strErr;
        $strInfo = $this->strInfo;

        $response = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";

        if ($strErr && strlen($strErr) > 0) {

            echo "$response<DIV style='height:150px; padding:10px 0 0 10px;' class='color_red'>$strErr</DIV>";
            return;
        }

        echo "$response<DIV style='height:150px; padding:10px 0 0 10px;'>$strInfo</DIV>";
    }
}