<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 03.09.13
 * Time: 7:26
 * To change this template use File | Settings | File Templates.
 */

/* @property GiftStrategy $strategy */
abstract class SelectGiftListView extends CompositeView
{
    protected $strategy;

    /* @param GiftStrategy $strategy */
    public function __construct($strategy)
    {
        parent::__construct();

        $this->strategy = $strategy;
        $length = count($this->loadGiftList());

        foreach ($this->loadGiftList() as $produce)
            $this->viewList[] = new SelectGiftView($produce, $this->strategy->getId(), $length == 1);
    }

    protected function echoHeaderTemplate()
    {
        $strategieId = $this->strategy->getId();
        $strategieName = $this->strategy->getName();

        if (count($this->loadGiftList()) > 0)
            echo "
        <TABLE align='center' cellpadding='0' cellapscing='0' border='0' width='100%' style='padding:20px 0 0 0;'>
            <FORM method='post' name='$strategieId'>
                <TR>
                    <TD colspan='2' width='100%' align='left' style='padding: 0 0 10px 20px; font-size:16px;' class='color_marsh arial_family'>
                        $strategieName
                    </TD>
                </TR>
        ";
    }

    protected function  echoFooterTemplate()
    {
        if (count($this->loadGiftList()) > 0)
            echo "
            </FORM>
        </TABLE>
        ";
    }

    /* @retrun DealProduce[] */
    protected abstract function loadGiftList();
}