<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 08.07.14
 * Time: 9:00
 */

/* @property PollReport $report */
class CustomerPollView extends View
{
    protected $report;

    public function __construct($report)
    {
        parent::__construct();

        $this->report = $report;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $question = $this->report->getQuestion()->getQuestion();
        $answer = $this->report->getAnswer()->getAnswer();

        echo "<TR><TD style='text-align:left; padding:5px 20px 5px 20px;'>$question</TD>
              <TD style='text-align:left; padding:5px 20px 5px 20px;'>$answer</TD></TR>";
    }
}