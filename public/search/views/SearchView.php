<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 07.04.14
 * Time: 8:35
 */
class SearchView extends CompositeView
{
    protected $produceTitle;

    public function __construct($produceTtitle)
    {
        $this->produceTitle = $produceTtitle;
    }

    protected function echoHeaderTemplate()
    {
        $produceTitle = $this->produceTitle;

        echo "
            <TABLE width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
                <TR>
                    <TD style='font-size: 0px; border-bottom-width: 1px; vertical-align: top;' class='bordercolor_lightgray'>&nbsp;</TD>
                 </TR>

                 <TR>
                    <TD style='vertical-align: top; padding:0 0 20px 0;'>
                        <TABLE border='0' cellpadding='0' cellspacing='0' align='center' width='700px'>
                            <TR>
                                <TD valign='top' style='padding: 20px 30px 20px 0px;'>
                                 <DIV style='padding:0 0 0 0; font-size: 20px' class='color_marsh'>
                                    <NOBR>Результаты поиска по запросу: $produceTitle</NOBR>
                                    </DIV>
                                </TD>
                            </TR>
                            <TR>
                                <TD>
        ";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TD></TR></TABLE>
              </TD></TR></TABLE>
              ";
    }
}