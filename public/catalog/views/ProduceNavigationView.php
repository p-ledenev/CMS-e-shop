<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 28.01.14
 * Time: 9:28
 */

/* @property Partition partition */
class ProduceNavigationView extends View
{
    protected $partition;

    public function __construct($partition)
    {
        $this->partition = $partition;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        $category = $this->partition->getCategory();

        echo "<DIV style='font-size: 12px;' class='color_azure arial_family'>";
        echo "<A href='/' style='text-decoration:underline;' class='color_azure'>Главная</A>";
        echo "&nbsp;&nbsp;&mdash;&nbsp;&nbsp;";

        echo "<SPAN style='text-decoration:underline;' class='color_azure'>" . $category->getName() . "</SPAN>";
        echo "&nbsp;&nbsp;&mdash;&nbsp;&nbsp;";

        echo "<A href='/" . $this->partition->getUrl() . "' style='text-decoration:underline;' class='color_azure'>" . $this->partition->getName() . "</A>";
    }
}