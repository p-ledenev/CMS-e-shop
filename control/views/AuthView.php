<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 28.08.13
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */

class AuthView extends View
{
    protected $strErr;

    public function __construct($strErr)
    {
        $this->strErr = $strErr;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo
            "
    <TABLE border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%'
           height='100%'>
        <TR>
            <TD>&nbsp;</TD>
        </TR>
        <TR>
            <TD width='100%' height='105' bgcolor='#CDD9ED'>
                <CENTER>" . $this->strErr . "</CENTER>
            <FORM name='forx' method='POST'>
                <P align='center'>
                    <FONT style='font-size:8pt;' face='Verdana' color='#FFFFFF'>Login</FONT>
                    <INPUT class='input' type='text' name='login' size='10'>
                    <FONT face='Verdana' style='font-size:8pt;' color='#FFFFFF'>&nbsp;Password</FONT>
                    <INPUT class='input' type='password' name='password' size='10'>
                    <INPUT type='hidden' name='c_auth' value='1'>
                    <INPUT border='0' src='/control/images/key.gif' name='I1' align='absmiddle' alt='Login' type='image'
                           width='30' height='29'></P>
            </FORM>

            <SCRIPT><!--
                document.forx.login.focus();
                // --></SCRIPT>

        </TD>
    </TR>
    <TR>
        <TD>&nbsp;</TD>
    </TR>
</TABLE>
       ";
    }
}