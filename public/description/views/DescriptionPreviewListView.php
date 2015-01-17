<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 10.01.14
 * Time: 14:57
 */

class DescriptionPreviewListView extends CompositeView
{
    /* @param Description[] $descriptionList */
    public function __construct($descriptionList)
    {
        parent::__construct();

        foreach ($descriptionList as $description)
            $this->viewList[] = new DescriptionPreviewView($description);
    }

    protected function echoHeaderTemplate()
    {
        echo "<TABLE cellpadding='0' cellspacing='0' border='0' align='left'>
            <TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}