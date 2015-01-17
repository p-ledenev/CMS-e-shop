<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 8:05
 * To change this template use File | Settings | File Templates.
 */

/* @property Navigation $navigation */
class NavigationView extends View
{
    protected $navigation;

    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;
    }

    public function getNavigation()
    {
        return $this->navigation;
    }

    public function __construct($navigation)
    {
        $this->navigation = $navigation;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $navigation = $this->getNavigation();
        $separator = (strpos($navigation->getUrl(), "?") !== false) ? "&" : "/?";

        $response = "
        <DIV style='padding:10' align='right'>
        <p style='margin:4px; color:navy;'>Страницы:&nbsp;
        ";

        $total = ($navigation->getTotalPages() < 8) ? $navigation->getTotalPages() : 7;
        for ($i = 1; $i <= $total; $i++) {
            if ($i == $navigation->getCurrentPage()) $response .= "<span class=pageS>$i</span>&nbsp;";
            else $response .= "<a href='/" . $navigation->getUrl() . $separator . "page=$i' class=page>$i</a>&nbsp;";
        }

        if ($navigation->getTotalPages() > 7)
            $response .= "...&nbsp;<a href='/" . $navigation->getUrl() .
                $separator . "page=" . $navigation->getTotalPages() . "' class=page>" . $navigation->getTotalPages() . "</a>&nbsp;";

        $response .= "
        &nbsp;<a href='/" . $navigation->getUrl() . $separator . "page=all' class=page>все</a>
        &nbsp;<a href='/" . $navigation->getUrl() . $separator . "page=nav' class=page>по стр.</a></p>
        </DIV>
        ";

        echo $response;
    }
}