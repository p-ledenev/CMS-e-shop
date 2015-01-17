<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 19.08.13
 * Time: 8:48
 * To change this template use File | Settings | File Templates.
 */

class DiscontStrategyFactory {

    public static function createDiscontStrategy($customer = null, $customeDiscontPercent = null) {

        return new SimpleDiscontStrategy($customer, $customeDiscontPercent);
    }
}