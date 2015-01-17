<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 02.07.14
 * Time: 7:52
 */

/* @property Customer $customer */
class CustomerProduceListContextView extends CompositeView
{
    protected $customer;

    public function  __construct($customer)
    {
        parent::__construct();

        $this->customer = $customer;

        $this->createViewList();
    }

    protected function echoHeaderTemplate()
    {
        echo "
          <DIV class='switch font17 color2' style='padding:30px 0 10px 1px;' colspan='3'>В разрезе продуктов</DIV>
          <TABLE cellpadding='0' cellspacing='0' style='border-collapse:collapse; border:1px solid #d3d3d3;' class='original_table' border='0'>
          <TR>
                <TH style='font-size:12px; color:#222; padding:5px 0px 5px 20px; text-align:left;'>Наименование</TD>
                <TH style='font-size:12px; color:#222; padding:5px 10px 5px 10px;'>Кол-во</TD>
                <TH style='font-size:12px; color:#222; padding:5px 10px 5px 10px;'>Сумма</TD>
          </TR>";
    }

    protected function echoFooterTemplate()
    {
        echo "</TABLE><BR>";
    }

    protected function createViewList()
    {
        $customer_id = $this->customer->getId();

        $dealProduceList = $this->customer->select("SELECT produce.produce AS id, SUM(produce.price * produce.amount) AS sum, SUM(produce.amount) AS amount,
                         GROUP_CONCAT(produce.deal SEPARATOR ';') AS deals
                         FROM deal AS deal
                         INNER JOIN deal_produce AS produce ON produce.deal=deal.id
                         INNER JOIN catalog AS catalog ON produce.produce=catalog.id
                         WHERE deal.customer=$customer_id
                         GROUP BY produce.produce
                         ORDER BY catalog.title
                         ");

        foreach ($dealProduceList as $dealProduce) {
            $produce = Produce::initEntityWithId("Produce", $dealProduce['id']);
            $dealList = $this->createDealList($dealProduce['deals']);

            $this->viewList[] = new CustomerProduceContextView($produce, $dealProduce['amount'], $dealProduce['sum'], $dealList);
        }
    }

    protected function createDealList($strItems)
    {
        $arItems = explode(";", $strItems);

        $dealList = Array();
        foreach ($arItems as $item)
            $dealList[] = Deal::initEntityWithId("Deal", $item);

        return $dealList;
    }
}