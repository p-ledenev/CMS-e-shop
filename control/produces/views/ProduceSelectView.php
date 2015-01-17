<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 8:32
 * To change this template use File | Settings | File Templates.
 */
class ProduceSelectView extends CompositeView
{
    /* @param ProduceFilter $filter */
    public function __construct($filter, $formName, $fieldName, $dispalyFieldName = null)
    {
        /* @var Produce[] $produceList */
        $produceList = $filter->loadItemList("Produce");

        $current = Produce::initEntity("Produce");
        foreach ($produceList as $produce) {
            if (!$produce->equals($current)) {
                $this->viewList[] = new SelectView($formName, $fieldName, $produce, $dispalyFieldName);
                $current = $produce;
            }
        }
    }

    protected function echoHeaderTemplate()
    {
        echo "
        <TABLE align='center' width='98%' cellpadding='5' cellspacing='5'>
        <TR><TD><FONT class='switch font17 color2'>Выбрать продукт</FONT></TD></TR>
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