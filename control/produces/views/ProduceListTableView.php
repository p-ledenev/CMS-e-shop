<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 12.08.13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */


/* @property Produce[] $produceList */
class ProduceListTableView extends CompositeView
{
    private $produceList;

    /* @param Produce[] $produceList */
    public function __construct($produceList, $url)
    {
        parent::__construct();
        $this->produceList = $produceList;

        $current = Produce::initEntity("Produce");
        foreach ($produceList as $produce) {
            if (!$produce->equals($current)) {
                $this->viewList[] = new ProduceTableView($produce, $url);
                $current = $produce;
            }
        }
    }

    protected function echoHeaderTemplate()
    {
        echo
        "
    <TABLE class='original_table' cellpadding='0' cellspacing='0' border='0' width='100%'>
        <TR>
            <TH>Приоритет</TH>
            <TH>Раздел</TH>
            <TH>Название</TH>
            <TH>Производитель</TH>
            <TH>Стоимость (руб.)</TH>
            <TH>Объем<BR>Наличие</TH>
            <TH>Рейтинг</TH>
            <TH>&nbsp;</TH>
        </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}