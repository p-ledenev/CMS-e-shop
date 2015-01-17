<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 8:32
 * To change this template use File | Settings | File Templates.
 */

class PartitionSelectView extends CompositeView
{
    /* @param PartitionFilter $filter */
    public function __construct($filter, $formName, $fieldName)
    {
        $arParams = $filter->getCategory()->getType()->getParams();
        $partitionList = $filter->loadItemList($arParams['childType']);

        foreach ($partitionList as $partition)
            $this->viewList[] = new SelectView($formName, $fieldName, $partition);
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <TABLE align='center' width='98%' cellpadding='5' cellspacing='5'>
        <TR><TD><FONT class='switch font17 color2'>Выбрать раздел</FONT></TD></TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "
        </TABLE>
    ";
    }
}

;