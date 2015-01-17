<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

/* @property partition $partition */
class PartitionTableView extends View
{
    private $partition;

    public function __construct($partition)
    {
        $this->partition = $partition;
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    public function getPartition()
    {
        return $this->partition;
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
        <TR onMouseOut='this.style.background=\"\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
        <TD>" . $this->partition->getSort() . "</TD>
        <TD>" . $this->partition->getCategory()->getName() . "</TD>
        <TD>" . $this->partition->getSubcategory()->getName() . "</TD>
        <TD><A href='/control/partitions/insert.php?id=" . $this->partition->getId() . "'>" . $this->partition->getName() . "</TD>
        <TD><A target='_blank' href='/" . $this->partition->getUrl() . "/'>" . $this->partition->getUrl() . "</A></TD>
        <TD>
            <A class='date'style='color:#D43424' onClick=\"delConfirm('/control/partitions/?delete=yes&partition_id=" . $this->partition->getId() . "', '¬ы действительно хотите удалить раздел?'); return false;\"
             href='javascript:void(0);'>del</A>
        </TD>
        </TR>
        ";
    }
}