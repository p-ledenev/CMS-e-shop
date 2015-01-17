<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 18.07.14
 * Time: 20:29
 */
class ProduceBannerIndexView extends BannerIndexView
{
    public function __construct($image, $produceId, $height, $border = Array(1, 1, 1, 1))
    {
        /* @var Produce $produce */
        $produce = Produce::initEntityWithId("Produce", $produceId);

        if ($produce->isPersisted())
            $url = $produce->createUrlFor();

        parent::__construct($image, $url, $height, $border);
    }
} 