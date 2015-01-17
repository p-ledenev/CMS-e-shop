<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.06.14
 * Time: 9:48
 */

/* @property Deal $deal */
class SelectDealGiftListView extends SelectGiftListView
{
    protected $deal;

    public function __construct($strategy, $deal)
    {
        $this->deal = $deal;

        parent::__construct($strategy);
    }

    /* @retrun DealProduce[] */
    protected function loadGiftList()
    {
        return $this->strategy->loadGiftListForDeal($this->deal);
    }
}