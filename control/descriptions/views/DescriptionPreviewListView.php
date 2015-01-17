<?php

/**
 * Created by PhpStorm.
 * User: dk
 * Date: 08.01.14
 * Time: 10:15
 */
class DescriptionPreviewListView extends CompositeView
{
    protected $showAddButton;
    protected $descriptionUrl;
    protected $produceId;

    /* @param Description[] $descriptionList */
    public function __construct($descriptionList, $descriptionUrl, $produceId, $showAddButton = true)
    {
        parent::__construct();
        $this->showAddButton = $showAddButton;
        $this->descriptionUrl = $descriptionUrl;
        $this->produceId = $produceId;

        foreach ($descriptionList as $description) {

            $currentUrl = "/control/produces/insert.php?id=" . $description->getProduce()->getId();
            $this->viewList[] = new DescriptionPreviewView($description, $descriptionUrl, $currentUrl);
        }
    }

    protected function echoHeaderTemplate()
    {
        echo "<TABLE cellpadding='5' cellspacing='5' border='0'>";

        if ($this->showAddButton)
            echo "<TR>
                   <TD><A href='javascript:void(0);' onClick='javascript:ShowWin(\"" . $this->descriptionUrl . "/?produce=" .
                $this->produceId . "\", 950, 700)'>Добавить</A></TD>
                  </TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}