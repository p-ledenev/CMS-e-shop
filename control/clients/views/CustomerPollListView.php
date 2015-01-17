<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.07.14
 * Time: 8:57
 */

/* @property Customer $customer */
class CustomerPollListView extends CompositeView
{
    /* @var Customer $customer */
    public function __construct($customer)
    {
        foreach ($customer->getReportList() as $report)
            $this->viewList[] = new CustomerPollView($report);
    }

    protected function echoHeaderTemplate()
    {
        echo "<div style='padding:30px 0 10px 0;' class='switch font17 color2'>Анкета клиента</div>
             <TABLE cellpadding='5' cellspacing='5' class='original_table'>
             <TR><TH style='text-align:left; padding:5px 20px 5px 20px;'>Вопрос</TH>
             <TH style='text-align:left; padding:5px 20px 5px 20px;'>Ответ</TH></TR>";
    }

    protected function  echoFooterTemplate()
    {
        echo "</TABLE>";
    }
}