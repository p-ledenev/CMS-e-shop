<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 10.01.14
 * Time: 14:36
 */

class DescriptionPreviewView extends DescriptionView
{
    protected function echoBodyTemplate()
    {
        $image = new Image($this->description->getId(), ImageType::$description);
        $src = $image->getThumbUrl();

        if (!$image->exist()) {
            $image = Image::getConstantRandomImageFor(ImageType::$cliparts, $this->description->getId());
            $src = $image->getFullUrl();
        }

        $imageView = "<img width='87' src='$src' border='0'>";

        echo "<TR>
                <TD style='padding:10px 20px 10px 0;'>" . $imageView . "</TD>
                <TD style='font-size:14px;' class='color_marsh arial_family'>" . $this->description->getDetail() . "</TD>
              </TR>";
    }
}