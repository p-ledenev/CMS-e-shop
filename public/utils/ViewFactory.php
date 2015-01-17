<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 29.08.13
 * Time: 9:52
 * To change this template use File | Settings | File Templates.
 */
class ViewFactory
{
    /* @param ProducePartition $partition */
    public static function createBottomCarouselForPartition($partition)
    {
        $filter = new ProduceFilter("/", $partition->getCategory(), $partition, null, true);

        $produceList = $filter->loadItemList("Produce");

        return self::createBottomCarouselFor($produceList, $partition->getName(), $partition);
    }

    /* @param Category $category */
    public static function createBottomCarouselForNewestCategoryPartition($category, $partition = null)
    {
        $defaultView = (!$partition) ? new NullView() : self::createBottomCarouselForPartition($partition);

        $newestSubcategory = Subcategory::initEntityByUrl("Subcategory", Constants::$categoriesNewestSubcategoryUrl);
        $partitionList = $category->getPartitionListBy($newestSubcategory);

        if (count($partitionList) <= 0)
            return $defaultView;

        $filter = new ProduceFilter("/", null, $partitionList[0], null, true);
        $produceList = $filter->loadItemList("Produce");

        if (count($produceList) <= 0)
            return $defaultView;

        $produceList = $partitionList[0]->getItemList();

        return self::createBottomCarouselFor($produceList, $partitionList[0]->getName());
    }

    public static function createHeadCarouselForTop()
    {
        $filter = new PartitionFilter("/", null, null, true, true);

        /* @var Partition[] $partitionList */
        $partitionList = $filter->loadItemList("ProducePartition");

        $imageList = Array();
        foreach ($partitionList as $partition)
            $imageList[] = new Image($partition->getId(), ImageType::$tops, "", "/" . $partition->getUrl() . "/");

        return CarouselView::createHeadCarousel($imageList);
    }

    /* @param Category $category */
    public static function  createHeadCarouselForCategory($category)
    {
        $filter = new PartitionFilter("/", $category, null, true);

        /* @var Partition[] $partitionList */
        $partitionList = $filter->loadItemList("ProducePartition");

        $imageList = Array();
        foreach ($partitionList as $partition)
            $imageList[] = new Image($partition->getId(), ImageType::$tops, "", "/" . $partition->getUrl() . "/");

        return CarouselView::createHeadCarousel($imageList);
    }

    public static function createPartitionTree($partitionList, $selectedPartition)
    {
        return new PartitionTreeView($partitionList, $selectedPartition);
    }

    /* @param Produce[] $produceList */
    protected static function createBottomCarouselFor($produceList, $title, $partition = null)
    {
        $imageList = Array();
        foreach ($produceList as $produce)
            $imageList[] = new Image($produce->getId(), ImageType::$catalog, $produce->getTitle(), $produce->createUrlFor($partition));

        return CarouselView::createBottomCarousel($imageList, $title);
    }

    /* @param View[] $viewList
     * @return View
     */
    public static function getRandomViewFromList($viewList)
    {
        $index = array_rand($viewList);

        return $viewList[$index];
    }
}