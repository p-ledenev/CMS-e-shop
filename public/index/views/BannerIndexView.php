<?php

/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 18.07.14
 * Time: 19:56
 */
class BannerIndexView extends View
{
    protected $image;
    protected $url;
    protected $border;
    protected $height;

    public function __construct($image, $url, $height, $border = Array(1, 1, 1, 1))
    {
        parent::__construct();

        $this->image = $image;
        $this->url = $url;
        $this->border = $border;
        $this->height = $height;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $image = $this->image;
        $url = $this->url;
        $border = $this->border;
        $height = $this->height;

        echo "
          <A href='$url' style='text-decoration:none;'>
          <DIV class='bordercolor_lightgray'
               style='border-top-width:1px; border-top-width:$border[0]px; border-right-width:$border[1]px;
                       border-bottom-width:$border[2]px; border-left-width:$border[3]px; width:100%; text-align:center;
               background: url(\"$image\") no-repeat 0 0; height:$height; width:100%'>
               &nbsp;
          </DIV>
          </A>
        ";
    }
} 