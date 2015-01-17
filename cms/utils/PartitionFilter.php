<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 7:26
 * To change this template use File | Settings | File Templates.
 */

/* @property Category $category
 * @property Subcategory $subcategory
 */
class PartitionFilter extends Filter
{
    private $category;
    private $subcategory;
    private $onMain;
    private $onlyVisible;

    public function __construct($url, $category, $subcategory = null, $onMain = false, $onlyVisible = true)
    {
        parent::__construct($url);

        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->onMain = $onMain;
        $this->onlyVisible = $onlyVisible;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function getSubcategory()
    {
        return $this->subcategory;
    }

    public function setFilter($cdata)
    {
        $this->category = Category::initEntityWithId("Category", $cdata['category_id']);

        $this->onMain = null;
        if ($cdata['onmain'] == 1) $this->onMain = true;
        if ($cdata['onmain'] == 0) $this->onMain = false;

        if ($cdata['subcategory_id'] > 0)
            $this->subcategory = Category::initEntityWithId("Subcategory", $cdata['subcategory_id']);
        else
            $this->subcategory = null;
    }

    protected function buildQuery()
    {
        $response = " FROM partition AS items WHERE 1";
        $response .= ($this->category) ? " AND category=" . $this->category->getId() : "";
        $response .= ($this->subcategory) ? " AND subcategory=" . $this->subcategory->getId() : "";
        $response .= ($this->onMain) ? " AND onmain=" . $this->onMain : "";
        $response .= ($this->onlyVisible) ? " AND visible=1" : "";

        return $response . " ORDER BY items.subcategory, items.sort ASC";
    }
}