<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

/* @property Produce $produce */
class ProduceTableView extends View
{
    private $produce;

    public function __construct($produce)
    {
        $this->produce = $produce;
    }

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $produce = $this->produce;
        $partitionList = $produce->getPartitionList();

        $quantity = $produce->getQuantity()->getParams();

        echo "
        <TR onMouseOut='this.style.background=\"\"' onMouseOver='this.style.background=\"#FFEEEE\"'>
    <TD>" . $produce->getSort() . "</TD>
    <TD>" . $partitionList[0]->getName() . "</TD>
    <TD><A href='/control/produces/insert.php?id=" . $produce->getId() . "'>" . $produce->getTitle() . "</A></TD>
    <TD>" . $produce->getVendor() . "</TD>
    <TD>" . $produce->getPrice() . "</TD>
    <TD>" . $produce->getCapacity() .
            "<BR><SPAN style='color:#1E3A8E; background-color:#$quantity[color]'>$quantity[title]</SPAN></TD>
    <TD>" . $produce->getRating() . "</TD>
    <TD>
        <A onClick=\"delConfirm('/control/produces/?delete=yes&produce_id=" . $produce->getId() . "', '¬ы действительно хотите удалить продукт?'); return false;\"
           href='javascript:void(0)'><FONT class='date red'>del</FONT></TD>
        </TR>
        ";
    }
}