<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 21.07.14
 * Time: 8:22
 */
class EmailDealDetailView extends CabinetDealDetailView
{
    protected function echoBodyTemplate()
    {
        include "emailDealDetailView.phtml";
    }
} 