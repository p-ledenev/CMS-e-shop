<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 14.08.13
 * Time: 7:45
 * To change this template use File | Settings | File Templates.
 */

/* @property Category $category
 * @property ProducePartition $partition
 */
class ProduceFilter extends Filter
{
    protected $category;
    protected $partition;
    protected $produceTitle;
    protected $quantity;

    public function __construct($url, $category, $partition, $produceTitle = null, $quantity = false)
    {
        parent::__construct($url);

        $this->category = $category;
        $this->partition = $partition;
        $this->produceTitle = $produceTitle;
        $this->quantity = $quantity;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setPartition($partition)
    {
        $this->partition = $partition;
    }

    public function getPartition()
    {
        return $this->partition;
    }

    public function setProduceTitle($produceTitle)
    {
        $this->produceTitle = $produceTitle;
    }

    public function getProduceTitle()
    {
        return $this->produceTitle;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setFilter($cdata)
    {
        if ($cdata['category_id'] > 0)
            $this->category = Category::initEntityWithId("Category", $cdata['category_id']);

        if ($cdata['partition'][$this->category->getId()] > 0)
            $this->partition = ProducePartition::initEntityWithId("ProducePartition", $cdata['partition'][$this->category->getId()]);

        $this->produceTitle = $cdata['produce_title'];
    }

    protected function buildQuery()
    {
        $response = ($this->category) ? " AND p.category=" . $this->category->getId() : "";
        $response .= ($this->partition) ? " AND p.id=" . $this->partition->getId() : "";
        $response .= ($this->quantity) ? " AND items.quantity >= 0" : "";

        $response = ($this->produceTitle) ? " AND items.title LIKE '%" . $this->getSQLValueFor("produceTitle") . "%'" : $response;

        $response = " FROM catalog AS items INNER JOIN catalog_prod2part AS pp ON pp.produce=items.id
                      INNER JOIN partition AS p ON p.id=pp.partition WHERE 1" . $response . " ORDER BY items.sort ASC";

        return $response;
    }
}