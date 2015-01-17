<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 10.01.14
 * Time: 15:06
 */
class DescriptionDetailView extends DescriptionView
{
    protected function echoBodyTemplate()
    {
        $id = $this->description->getId();
        $title = mb_strtoupper($this->description->getTitle(), "windows-1251");
        $fullDetail = $this->description->getPreview() . $this->description->getDetail();

        if ($this->description->getPreview()) {
            $previewDetail = $this->description->getPreview();

        } else {

            $previewLength = 600;
            $previewDetail = $this->description->getDetail();
            if (strlen($previewDetail) > $previewLength) {
                $previewDetail = substr($this->description->getDetail(), 0, $previewLength);
                $previewDetail = substr($previewDetail, 0, $this->strrposa($previewDetail, Array('>', '.', ',', ' ')) + 1);
            }
        }

        echo "
             <TR><TD style='height: 30px; padding: 30px 0 0px 5px; font-size:20px; border-bottom-width: 1px;'
             class='bordercolor_lime color_lime'>
             $title</TD></TR>
             <TR id='preview_detail_$id'><TD style='padding: 10px 0 0px 0px;' class='color_marsh arial_family'>$previewDetail</TD></TR>
             <TR id='full_detail_$id' style='display:none;'><TD style='padding: 10px 0 0px 0px;' class='color_marsh arial_family'>$fullDetail</TD></TR>
             ";

        if (strlen($fullDetail) > strlen($previewDetail))
            echo "<TR><TD style='text-align: right; padding:0 0px 0px 0;'>
                    <A class='color_azure arial_family' style='font-size:12px;'
                    href='javascript:void(0);'
                    onclick='changeDisplayOptionFor(\"full_detail_$id\");
                             changeDisplayOptionFor(\"preview_detail_$id\");
                             changeRollInnerText(this);
                             return false;'>
                             читать далее
                    </A>
             </TD></TR>";
    }

    function strrposa($haystack, $needle, $offset = 0)
    {
        if (!is_array($needle))
            $needle = array($needle);

        foreach ($needle as $query) {
            $result = strrpos($haystack, $query, $offset);
            if ($result !== false && $result > 4)
                return $result;
        }

        return false;
    }
}

