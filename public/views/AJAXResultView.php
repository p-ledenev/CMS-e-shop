<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 06.05.14
 * Time: 18:00
 */
class AJAXResultView extends View
{
    protected $resultId;

    public function __construct($resultId)
    {
        parent::__construct();

        $this->resultId = $resultId;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $resultId = $this->resultId;

        echo "
            <div id='$resultId' class='bordercolor_lightgray'
                style='display:none; position:fixed; top:100px; left:40%; z-index:3;
                background-color:white; width:350px; border-width:1px;
                text-align:center; vertical-align:middle; padding: 40px 40px 40px 40px;'>
            </div>
        ";
    }
}