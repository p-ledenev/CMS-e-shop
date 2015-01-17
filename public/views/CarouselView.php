<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.08.13
 * Time: 8:15
 * To change this template use File | Settings | File Templates.
 */

/* @property Image[] $imageList */
class CarouselView extends View
{
    protected $imageList;
    protected $carouselId;
    protected $styleClass;
    protected $imageWidth;
    protected $isCycle;
    protected $imageNum;
    protected $backgroundImage;
    protected $title;
    protected $useSource;

    public static function createHeadCarousel($imageList, $title = null)
    {
        $view = new CarouselView($imageList);
        $view->setCarouselId("head-carousel");
        $view->setStyleClass("one_direction_carousel");
        $view->setTitle($title);
        $view->setImageWidth(150);
        $view->setIsCycle(true);
        $view->setImageNum(5);
        $view->setUseSource(true);
        $view->setBackgroundImage("/jquery_plugins/master_carousel/round_back3.jpg");

        return $view;
    }

    public static function createBottomCarousel($imageList, $title = null)
    {
        $view = new CarouselView($imageList);
        $view->setCarouselId("bottom-carousel");
        $view->setStyleClass("carousel");
        $view->setTitle($title);
        $view->setImageWidth(150);
        $view->setIsCycle(false);
        $view->setImageNum(4);
        $view->setUseSource(false);

        return $view;
    }

    public function __construct($imageList)
    {
        parent::__construct();

        $this->imageList = $imageList;
    }

    public function setUseSource($useSource)
    {
        $this->useSource = $useSource;
    }

    public function getUseSource()
    {
        return $this->useSource;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setCarouselId($carouselId)
    {
        $this->carouselId = $carouselId;
    }

    public function getCarouselId()
    {
        return $this->carouselId;
    }

    public function setImageList($imageList)
    {
        $this->imageList = $imageList;
    }

    public function getImageList()
    {
        return $this->imageList;
    }

    public function setStyleClass($styleClass)
    {
        $this->styleClass = $styleClass;
    }

    public function getStyleClass()
    {
        return $this->styleClass;
    }

    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;
    }

    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    public function setIsCycle($isCycle)
    {
        $this->isCycle = $isCycle;
    }

    public function getIsCycle()
    {
        return $this->isCycle;
    }

    public function setImageNum($imageNum)
    {
        $this->imageNum = $imageNum;
    }

    public function getImageNum()
    {
        return $this->imageNum;
    }

    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }

    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    protected function echoHeaderTemplate()
    {
        if (!$this->title)
            return;

        $title = $this->title;

        echo "
            <DIV class='bordercolor_lightgray'
                style='height: 40px; border-bottom-width:1px; padding: 30px 0 0 20px; color:#f89118; font-size: 26px; text-align:left;'>
                $title
            </DIV>
            <DIV class='bordercolor_lightgray' style='padding:10px 0 0 0;'>&nbsp;</DIV>
        ";
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "carouselView.phtml";
    }
}