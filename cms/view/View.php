<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:19
 * To change this template use File | Settings | File Templates.
 */

abstract class View
{
    public function __construct()
    {
    }

    protected abstract function echoHeaderTemplate();

    protected abstract function  echoFooterTemplate();

    protected abstract function echoBodyTemplate();

    public function getHeader()
    {
        ob_start();
        $this->echoHeaderTemplate();

        $response = ob_get_contents();
        ob_end_clean();

        return $response;
    }

    public function getFooter()
    {
        ob_start();
        $this->echoFooterTemplate();

        $response = ob_get_contents();
        ob_end_clean();

        return $response;
    }

    public function getBody()
    {
        ob_start();
        $this->echoBodyTemplate();

        $response = ob_get_contents();
        ob_end_clean();

        return $response;
    }

    public function view()
    {
        echo $this->getContent();
    }

    public function getContent()
    {
        $response = $this->getHeader();
        $response .= $this->getBody();
        $response .= $this->getFooter();

        return $response;
    }
}

;