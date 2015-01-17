<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 13.01.14
 * Time: 9:13
 */

/* @property Article $article */
class ArticleSquareView extends View
{
    protected $article;
    protected $index;

    public function __construct($article, $index)
    {
        $this->article = $article;
        $this->index = $index;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $image = new Image($this->article->getId(), ImageType::$articlePreview, $this->article->getTitle(), $this->article->createUrl());

        $title = mb_strtoupper($this->article->getTitle(), "cp1251");
        $preview = $this->article->getPreview();
        $url = $this->article->createUrl();

        if ($image->exist())
            $imageView = "<A target='_blank' href='" . $this->article->createUrl() . "'><IMG border='0' width='160px' src='" . $image->getThumbUrl() . "'</A>";

        if ($this->index % 2 == 0)
            echo "</TR><TR>";

        echo "<TD width='50%' style='vertical-align:top;'>
            <TABLE>
                <TR>
                  <TD rowspan='2' style='vertical-align:top; padding:10px 0 10px 0; width:120px;'>$imageView</TD>
                  <TD style='padding:10px 20px 10px 20px; vertical-align: top;'>
                    <A style='font-size:12px;' class='color_marsh arial_family' href='$url'>$title</A>
                  </TD>
                </TR>
                <TR>
                  <TD style='padding:0px 20px 10px 20px; vertical-align: top;'>
                    <A style='font-size:10px;' class='color_warmgray arial_family' href='$url'>$preview</A>
                  </TD>
                </TR>
            </TABLE>
            </TD>";
    }
}