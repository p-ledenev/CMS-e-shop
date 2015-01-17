<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.06.14
 * Time: 9:45
 */

class SelectFullGiftListView extends SelectGiftListView{

    /* @retrun DealProduce[] */
    protected function loadGiftList()
    {
        return $this->strategy->loadFullGiftList();
    }
}