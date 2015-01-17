<?php

/**
 * Created by PhpStorm.
 * User: dk
 * Date: 08.01.14
 * Time: 10:22
 */

/* @property Description $description */
class DescriptionPreviewView extends View
{
    protected $description;
    protected $descriptionUrl;
    protected $currentUrl;

    public function __construct($description, $descriptionUrl, $currentUrl)
    {
        $this->description = $description;
        $this->descriptionUrl = $descriptionUrl;
        $this->currentUrl = $currentUrl;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo "<TR><TD><A href='javascript:void(0);' onClick='javascript:ShowWin(\"" . $this->descriptionUrl . "/?id=" . $this->description->getId() . "\", 950, 700)'>" .
            "<H2 style='color:#555;font-size:16px;'>" .
            $this->description->toDetailString() . "</H2></A></TD>" .
            "<TD><A class='red' href='javascript:void(0);' onClick=\"delConfirm('" . $this->currentUrl . "&description=" .
            $this->description->getId() . "&delete=yes','¬ы действительно хотите удалить описание товара?'); return false;\">del</A></TD>";

    }
}