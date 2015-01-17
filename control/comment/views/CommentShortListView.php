<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.02.14
 * Time: 9:10
 */

class CommentShortListView extends CommentListView
{
    public function getViewId()
    {
        return "shortCommentList";
    }

    protected function getShowId()
    {
        $fullView = new CommentFullListView(array());
        return $fullView->getViewId();
    }

    protected function getTitle()
    {
        return "ÏÎÊÀÇÀÒÜ ÂÑÅ";
    }
}