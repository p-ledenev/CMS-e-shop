<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 07.05.14
 * Time: 8:12
 */

class ComplexCompositeView extends CompositeView
{
    protected $headViewList;
    protected $footViewList;

    public function setFootViewList($footViewList)
    {
        $this->footViewList = $footViewList;
    }

    public function getFootViewList()
    {
        return $this->footViewList;
    }

    public function setHeadViewList($headViewList)
    {
        $this->headViewList = $headViewList;
    }

    public function getHeadViewList()
    {
        return $this->headViewList;
    }

    public function __construct($viewList = Array(), $headViewList = Array(), $footViewList = Array())
    {
        parent::__construct($viewList);

        $this->headViewList = $headViewList;
        $this->footViewList = $footViewList;
    }

    protected function echoHeaderTemplate()
    {
        echo $this->printViewList($this->headViewList);
    }

    protected function echoFooterTemplate()
    {
        echo $this->printViewList($this->footViewList);
    }
}