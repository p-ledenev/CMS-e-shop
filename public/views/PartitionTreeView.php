<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.08.13
 * Time: 18:47
 * To change this template use File | Settings | File Templates.
 */

/* @property ProducePartition[] $partitionList
 * @property ProducePartition $selectedPartition
 */
class PartitionTreeView extends View
{
    protected $partitonList;

    public function __construct($partitionList, $selectedPartition)
    {
        $this->partitionList = $partitionList;
        $this->selectedPartition = $selectedPartition;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo "
        <TABLE cellpadding='0' cellspacing='0' border='0' width='100%'>";

        $lastSubcategory = Subcategory::initEntity("Subcategory");
        foreach ($this->partitionList as $partition) {

            /* @var Produce[] $itemList [] */
            $itemList = $partition->getItemList();

            if (count($itemList) <= 0 || !$partition->isAnyProduceAvailable())
                continue;

            $url = (count($itemList) > 1) ? ("/" . $partition->getUrl() . "/") : $itemList[0]->createUrlFor($partition);

            $backColor = "";
            $aColor = "color_marsh";

            if ($partition->equals($this->selectedPartition)) {
                $backColor = "backcolor_lightwarmgray";
                $aColor = "color_marsh";
            }

            $paddingTop = (!$lastSubcategory->equals($partition->getSubcategory()))
                ?
                "<TR><TD style='padding:30px 10px 5px 20px; font-size:18px;' class='color_orange'>" . mb_strtoupper($partition->getSubcategory()->getName(), "cp1251") . "</TD></TR>"
                :
                "";
            $lastSubcategory = $partition->getSubcategory();

            echo "$paddingTop
                  <TR>
                    <TD style='padding: 5px 10px 5px 20px; font-size:16px;' class='$backColor'>
                        <A class='$aColor' href='$url'>" . $partition->getName() . "</A>
                     </TD>";
        }

        echo "
            </TABLE>
        ";
    }
}