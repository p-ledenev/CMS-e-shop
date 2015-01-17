<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 24.01.14
 * Time: 8:39
 */

/* @property Category $category */
class MenuItemOneColumnView extends View
{
    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        echo "<TD style='text-align:center; height:40px;'>
        <A style='text-decoration:none; padding: 0 10px 0 10px;' href='#' lTo='/" . $this->category->getUrl() . "/'>" .
            $this->category->getName() . "</A>
        <UL>";

        foreach ($this->category->getPartitionList() as $partition)
            echo "<LI><A href='/" . $partition->getUrl() . "'>" . $partition->getName() . "</A></LI>";

        echo "</UL></TD>";
    }
}