<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.02.14
 * Time: 9:10
 */

/* @property Comment $comment */
class CommentView extends View
{
    protected $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $comment = $this->comment->getComment();
        $date = date("d.m.Y h:i:s", $this->comment->getDate());
        $name = $this->comment->getName();

        echo "<TR><TD style='padding: 0px 0 20px 0;'>
        <TABLE border='0' cellpadding='0' cellspacing='0' width='100%'>
        <TR><TD><SPAN class='color_azure arial_family' style='font-size:12px; padding: 0 5px 0 0;'>$date</SPAN>&nbsp;
        <SPAN class='color_brown' style='font-size:14px; font-weight:500;'>$name</SPAN></TD></TR>
        <TR><TD style='font-size: 14px; padding: 5px 0 0 0;' class='color_warmgray arial_family'>$comment</TD></TR>
        </TABLE>
        </TD></TR>";
    }
}