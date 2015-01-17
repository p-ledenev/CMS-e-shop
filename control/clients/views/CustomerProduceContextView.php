<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 02.07.14
 * Time: 8:21
 */

/* @property Produce $produce
 * @property Deal[] $dealList
 */
class CustomerProduceContextView extends View
{
    protected $produce;
    protected $amount;
    protected $sum;

    public function __construct($produce, $amount, $sum, $dealList)
    {
        parent::__construct();

        $this->produce = $produce;
        $this->amount = $amount;
        $this->sum = $sum;
        $this->dealList = $dealList;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $title = "<A target='_blank' href='" . $this->produce->createUrlFor() . "'>" . $this->produce->getTitle() . "</A>";
        $amount = $this->amount;
        $sum = $this->sum;

        $title .= "<BR>заказы:";
        foreach ($this->dealList as $deal)
            $title .= "<A style='text-decoration:none;' target='_blank' href='/control/deals/insert.php?id=" .
                $deal->getId() . "' class='fontMedium'>" . $deal->getId() . "</A>;";

        echo "<TR>
              <TD style='color:#777; padding: 5px 5px 5px 20px; text-align:left;'>$title</TD>
              <TD style='text-align:center; color:#333; border-color:#d3d3d3;'>$amount</TD>
              <TD style='text-align:center; color:#333; border-color:#d3d3d3;'>$sum руб.</TD>
              </TR>";
    }
}