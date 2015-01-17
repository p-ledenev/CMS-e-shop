<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 10.01.14
 * Time: 14:36
 */

class DescriptionDetailListView extends CompositeView
{
    /* @param Description[] $descriptionList */
    public function __construct($descriptionList)
    {
        parent::__construct();

        foreach ($descriptionList as $description)
            $this->viewList[] = new DescriptionDetailView($description);
    }

    protected function echoHeaderTemplate()
    {
        echo "<TABLE cellpadding='0' cellspacing='0' border='0'><TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TR></TABLE>";
    }
}

;