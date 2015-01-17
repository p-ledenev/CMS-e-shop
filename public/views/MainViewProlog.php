<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 21.08.13
 * Time: 20:25
 * To change this template use File | Settings | File Templates.
 */

/* @property ComplexCompositeView $complexView */
class MainViewProlog extends View
{
    protected $complexView;

    public function __construct()
    {
        parent::__construct();

        $this->complexView = new ComplexCompositeView();
    }

    public function setFootViewList($footViewList)
    {
        $this->complexView->setFootViewList($footViewList);
    }

    public function setHeadViewList($headViewList)
    {
        $this->complexView->setHeadViewList($headViewList);
    }

    public function setViewList($viewList)
    {
        $this->complexView->setViewList($viewList);
    }

    protected function echoHeaderTemplate()
    {
        include "mainViewPrologHeader.phtml";
        echo $this->complexView->getHeader();
    }

    protected function echoFooterTemplate()
    {
        echo $this->complexView->getFooter();
        echo "
        </BODY>
        </HTML>
        ";
    }

    protected function echoBodyTemplate()
    {
        echo $this->complexView->getBody();
    }
}