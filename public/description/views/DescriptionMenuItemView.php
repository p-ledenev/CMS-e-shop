<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 10.01.14
 * Time: 15:06
 */

class DescriptionMenuItemView extends DescriptionView
{
    protected function echoBodyTemplate()
    {
        $selected = "bookmark.jpg";
        if ($this->description->getTitle() == "Описание")
            $selected = "bookmark_selected.jpg";

        echo "<TD style='color:#555; font-size:14px; padding:0 0 0 10px;
              background-image:url(\"/images/$selected\"); background-repeat: no-repeat;
              width:100px; height:32px;'><NOBR>" .
            $this->description->getTitle() .
            "</NOBR></TD>";
    }
}