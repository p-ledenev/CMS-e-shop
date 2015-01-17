<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 10.01.14
 * Time: 14:36
 */

class DescriptionMenuView extends CompositeView
{
    /* @param Description[] $descriptionList */
    public function __construct($descriptionList)
    {
        parent::__construct();

        /* @var Description $description */
        $description = DetailDescription::initEntity("DetailDescription");
        $description->setTitle("Описание");

        $this->viewList[] = new DescriptionMenuItemView($description);

        foreach ($descriptionList as $description)
            $this->viewList[] = new DescriptionMenuItemView($description);

        $description = DetailDescription::initEntity("DetailDescription");
        $description->setTitle("Отзывы");

        $this->viewList[] = new DescriptionMenuItemView($description);
    }

    protected function echoHeaderTemplate()
    {
        echo "<TABLE cellpadding='0' cellspacing='0' border='0' width='100%'><TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "<TD style='background-image:url(\"/images/line.jpg\");'>&nbsp;</TD></TR></TABLE>";
    }
}

;