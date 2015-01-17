<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 26.11.13
 * Time: 9:35
 */

class SimpleTextView extends View
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo $this->text;
    }
}

;