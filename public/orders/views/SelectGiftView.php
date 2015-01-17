<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 03.09.13
 * Time: 7:27
 * To change this template use File | Settings | File Templates.
 */

/* @property DealProduce $produce */
class SelectGiftView extends View
{
    protected $produce;
    protected $name;
    protected $selected;

    public function __construct($produce, $name, $selected = false)
    {
        $this->produce = $produce;
        $this->name = $name;
        $this->selected = $selected;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $partitionList = $this->produce->getProduce()->getPartitionList();
        $url = $partitionList[0]->getUrl();

        $name = $this->name;
        $produceId = $this->produce->getProduce()->getId();
        $amount = $this->produce->getAmount();
        $title = $this->produce->getProduce()->getTitle();
        $selected = ($this->selected) ? "checked" : "";

        echo "
        <TR>
            <TD valign='middle' style='padding:3px 0 3px 0; text-align:center;'>
            <INPUT type='radio' name='$name' value='$produceId;$amount'
            onClick='select_gift(\"$name\", \"$produceId;$amount\");' $selected>
            </TD>
            <TD valign='middle' style='text-align:left; padding: 3px 0 3px 10px; font-size:14px;' width='95%'>
                <A class='color_azure arial_family' target='_blank' href='/$url/$produceId/'>$title</A>
            </TD>
        </TR>
        ";
    }
}