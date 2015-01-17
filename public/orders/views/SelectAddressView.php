<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 03.09.13
 * Time: 7:49
 * To change this template use File | Settings | File Templates.
 */

/* @property Address $address */
class SelectAddressView extends View
{
    protected $address;
    protected $giftForm;

    public function __construct($address, $giftForm)
    {
        $this->address = $address;
        $this->giftForm = $giftForm;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $this->address->initEntityById();
        echo "<TR><TD>
                         <TABLE align='left' cellpadding='10' cellspacing='10' border='0'>
                            <FORM method='post' name='exta_" . $this->address->getId() . "' action='/orders/'>
                                " . $this->giftForm . "
                                <INPUT type='hidden' name='address_id' value='" . $this->address->getId() . "'>
                                <TR>
                                    <TD style='text-align:justify; padding:5px 40px 5px 20px; font-size: 14px;' width='548px' class='color_gray arial_family'>
                                        " . $this->address->toDetailString() . "
                                    </TD>
                                    <TD width='75px' style='padding:0 20px 0 0;'>
                                        <A href='javascript:void(0);'
                                           style='text-decoration:none;'
                                           onClick='validate_gift(\"exta_" . $this->address->getId() . "\"); return false;'>
                                            <DIV class='backcolor_orange bordercolor_orange color_white'
                                                 style='padding: 5px 10px 5px 10px; width:75px; text-align:center; font-size:14px; font-weight:500;'>
                                                ƒ¿À≈≈
                                            </DIV>
                                        </A>
                                    </TD>
                                </TR>
                            </FORM>
                        </TABLE>
              </TD></TR>
        ";
    }
}