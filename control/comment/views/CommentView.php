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
    protected $url;

    public function __construct($comment, $url)
    {
        $this->comment = $comment;
        $this->url = $url;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $url = $this->url . ((strpos($this->url, "?") !== false) ? "&" : "?");
        $id = $this->comment->getId();

        $comment = $this->comment->getComment();
        $date = date("d.m.Y h:i:s", $this->comment->getDate());
        $name = $this->comment->getName();

        echo "<TR><TD style='padding: 0 0 10px 0;' align='left'>
        <TABLE border='0' cellpadding='0' cellspacing='0'>
        <TR><TD colspan='2'><SPAN style='font-size:10px; color:gray'>$date</SPAN>&nbsp;
        <SPAN style='font-size:12px; color:#333;'>$name</SPAN></TD></TR>
        <TR><TD style='font-size:12px; color:#555;'>$comment</TD>
        <TD style='padding: 0 0 0 20px;'>
        <A href='' onClick=\"delConfirm('$url delete=yes&comment_id=$id','Вы действительно хотите удалить отзыв?'); return false;\"
        style='color: #EF3B39; font-size: 12px;'>del</A></TD></TR>
        </TABLE>
        </TD></TR>";
    }
}