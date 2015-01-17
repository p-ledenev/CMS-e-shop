<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 8:03
 * To change this template use File | Settings | File Templates.
 */

class PopupCartClearView extends View
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
        <meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
        <TABLE width='100%' align='center' style='text-align:center' cellpadding='10' cellspacing='10'>
    <TR>
        <TD style='font-weight:bold;'>Корзина очищена</TD>
    </TR>
    <TR>
        <TD style='font-style:italic;'>
            <HR noshade size='1px'>
        </TD>
    </TR>
        </TABLE>
        <SCRIPT>
           window.opener.location.reload();
           setTimeout(\"window.close()\", 1000);
        </SCRIPT>
        ";
    }
}