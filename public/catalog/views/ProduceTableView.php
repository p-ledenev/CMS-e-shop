<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 13.01.14
 * Time: 9:13
 */

/* @property Produce $produce */
class ProduceTableView extends View
{
    protected $produce;

    public function setProduce($produce)
    {
        $this->produce = $produce;
    }

    public function getProduce()
    {
        return $this->produce;
    }

    public function __construct($produce)
    {
        $this->produce = $produce;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $image = new Image($this->produce->getId(), ImageType::$catalog, $this->produce->getTitle(), $this->produce->createUrlFor());

        if ($image->exist())
            $imageView = "<A target='_blank' href='" . $this->produce->createUrlFor() . "'><IMG border='0' width='100px' src='" . $image->getThumbUrl() . "'</A>";

        echo "<TR><TD style='vertical-align:top; padding:10px 0 10px 0;'>" . $imageView .
            "</TD><TD style='padding:10px 0 10px 0;'><A target='_blank' style='font-size:14px;' class='color_marsh arial_family' href='" .
            $this->produce->createUrlFor() . "'>" . $this->produce->getPreview() . "</A></TD></TR>";
    }
}