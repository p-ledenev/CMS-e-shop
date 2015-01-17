<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 04.09.13
 * Time: 19:25
 * To change this template use File | Settings | File Templates.
 */

/* @property DealProduce $produce */
class OrderGiftView extends View
{
    protected $produce;

    public function __construct($produce)
    {
        $this->produce = $produce;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $produce = $this->produce->getProduce();
        $partitionList = $produce->getPartitionList();
        $amount = ($this->produce->getAmount() > 1) ? "; " . $this->produce->getAmount() . "רע." : "";

        $url = $partitionList[0]->getUrl();
        $produceId = $produce->getId();
        $producetitle = $produce->getTitle();
        $preview = $produce->getPreview();

        $image = new Image($produce->getId(), ImageType::$catalog);
        $imageUrl = $image->getThumbUrl();

        echo "
            <TR><TD style='padding:0 0 20px 0;'>
            <TABLE cellpadding='0' cellspacing='0'><TR>
               <TD rowspan='2' align='center' width='180px'>
                 <A target='_blank' href='/$url/$produceId'><IMG src='$imageUrl'></A>
               </TD>
               <TD valign='top' align='left' style='text-align:left'>
                 <A class='color_azure arial_family' target='_blank' href='/$url/$produceId'>
                 $producetitle$amount
                 </A>
               </TD></TR>
               <TR>
                 <TD style='font-style:italic; font-size:12px; vertical-align:top; padding:10px 0 0 0;'>
                 <A class='color_gray arial_family' target='_blank' href='/$url/$produceId'>
                 $preview
                 </A></TD>
               </TR></TABLE>
            </TD></TR>
        ";
    }
}