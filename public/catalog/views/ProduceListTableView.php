<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 13.01.14
 * Time: 9:11
 */

/* @property Partition  $partition */
class ProduceListTableView extends CompositeView
{
    protected $partition;

    public function __construct($produceList, $partition)
    {
        parent::__construct();

        foreach ($produceList as $produce)
            $this->viewList[] = new ProduceTableView($produce);

        $this->partition = $partition;
    }

    protected function echoHeaderTemplate()
    {
        $title = ($this->partition->getPreview()) ? mb_strtoupper($this->partition->getPreview(), "cp1251") : "œŒ’Œ∆¿ﬂ ‘Œ–Ã”À¿";

        echo "<TABLE cellpadding='0' cellspacing='0' border='0' width='100%'>
            <TR>
        <TD colspan='2'
            style='height: 30px; border-bottom-width: 1px; padding: 0px 0 0px 5px; font-size:20px;' class='bordercolor_lime color_lime'>
            $title
        </TD>
        <TR><TD>&nbsp;</TD></TR>
    </TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}