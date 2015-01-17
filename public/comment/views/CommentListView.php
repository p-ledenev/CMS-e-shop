<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.02.14
 * Time: 9:39
 */

abstract class CommentListView extends CompositeView
{
    protected $visible;

    public function __construct($commentList, $count = 3, $visible = true)
    {
        parent::__construct();

        $this->visible = $visible;

        foreach ($commentList as $i => $comment)
            if ($i < $count)
                $this->viewList[] = new CommentView($comment);
    }

    protected function echoHeaderTemplate()
    {
        $tableId = $this->getViewId();
        $visible = ($this->visible == true) ? "display:1;" : "display:none;";

        echo "<TABLE cellpadding='0' cellspacing='0' border='0' width='100%' id='$tableId'' style='$visible'>
            <TR>
        <TD colspan='2'
            style='height: 30px; border-bottom-width: 1px; padding: 0px 0 0px 5px; font-size:20px;' class='bordercolor_lime color_lime'>
            Œ“«€¬€
        </TD>
        <TR><TD>&nbsp;</TD></TR>
    </TR>";
    }

    protected function  echoFooterTemplate()
    {
        $hideId = $this->getViewId();
        $showId = $this->getShowId();
        $title = $this->getTitle();

        echo "<TR>
        <TD style='text-align:right;'>
          <A href='javascript:void(0);' onClick='hideElementBy(\"$hideId\"); showElementBy(\"$showId\"); return false;'
            class='color_azure arial_family' style='font-size:12px;'>
            $title
          </A>
        </TD>
        </TR>
        </TABLE>";
    }

    abstract public function getViewId();

    abstract protected function getShowId();

    abstract protected function getTitle();
} 