<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */

class PartitionListTableView extends CompositeView
{
    public function __construct($partitionList, $url)
    {
        parent::__construct();

        foreach ($partitionList as $partition)
            $this->viewList[] = new PartitionTableView($partition, $url);

    }

    protected function echoHeaderTemplate()
    {
        echo
        "
        <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH>Приоритет</TH>
            <TH>Категория</TH>
            <TH>Подкатегория</TH>
            <TH>Название</TH>
            <TH>Url</TH>
            <TH>&nbsp;</TH>
        </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}