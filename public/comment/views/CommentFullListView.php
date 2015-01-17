<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 27.02.14
 * Time: 9:42
 */

class CommentFullListView extends CommentListView
{
    public function __construct($commentList, $visible = true)
    {
        parent::__construct($commentList, count($commentList), $visible);
    }

    public function getViewId()
    {
        return "fullCommentList";
    }

    protected function getShowId()
    {
        $shortView = new CommentShortListView(array());
        return $shortView->getViewId();
    }

    protected function getTitle()
    {
        return "скрыть";
    }
}