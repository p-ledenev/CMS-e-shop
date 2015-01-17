<?php

/**
 * Created by PhpStorm.
 * User: dk
 * Date: 08.01.14
 * Time: 10:56
 */

/* @property Description $description */
class PreviewDescriptionInsertView extends DescriptionInsertView
{
    protected function echoBodyTemplate()
    {
        include "previewDescriptionInsertView.phtml";
    }
}