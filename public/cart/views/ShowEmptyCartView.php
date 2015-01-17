<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 18:06
 * To change this template use File | Settings | File Templates.
 */

class ShowEmptyCartView extends View
{

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo "
        <DIV style='vertical-align: top; height:400px;'>
            <NOBR>бюью йнпгхмю осярю</NOBR>
        </H1>
        ";
    }
}