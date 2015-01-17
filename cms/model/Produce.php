<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 8:07
 * To change this template use File | Settings | File Templates.
 */

/* @property Partition[] $partitionList
 * @property Category[] $categoryList
 * @property Article[] $articleList
 * @property Produce[] $programList
 * @property Produce[] $inProgramList
 * @property Deal[] $dealList
 * @property ProduceQuantity $quantity
 * @property PreviewDescription[] $previewList;
 * @property DetailDescription[] $detailList;
 * @property ProduceComment[] $commentList;
 * @property SubscriptionItem[] $subscriptionList;
 * @property DosheEffect[] $dosheEffectList;
 */
class Produce extends PersistableEntity
{
    protected $price;
    protected $specialPrice;
    protected $currency;
    protected $vendor;
    protected $vendorLocation;
    protected $title;
    protected $capacity;
    protected $expiry;
    protected $audio;
    protected $quantity;
    protected $rating;
    protected $giftAmount;
    protected $sort;
    protected $preview;

    protected $previewList;
    protected $detailList;

    protected $partitionList;
    protected $categoryList;
    protected $dealList;
    protected $articleList;
    protected $programList;
    protected $inProgramList;
    protected $commentList;
    protected $subscriptionList;
    protected $dosheEffectList;

    public function __construct()
    {
        parent::__construct();

        $this->currency = "rub";
    }

    public function setDosheEffectList($dosheList)
    {
        $this->dosheEffectList = $dosheList;
    }

    /* @return DosheEffect[] */
    public function getDosheEffectList()
    {
        if ($this->dosheEffectList)
            return $this->dosheEffectList;

        $arrItems = $this->select("SELECT doshe, value FROM catalog_doshe WHERE produce=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = DosheEffect::createForArray($item);

        $this->dosheEffectList = $items;

        return $this->dosheEffectList;
    }

    /* @param Doshe $doshe */
    public function getDosheEffectBy($doshe)
    {
        foreach ($this->getDosheEffectList() as $dosheEffect)
            if ($doshe->equals($dosheEffect->getDoshe()))
                return $dosheEffect;

        return DosheEffect::createForDoshe($doshe);
    }

    public function setCategoryList($categoryList)
    {
        $this->categoryList = $categoryList;
    }

    public function getCategoryList()
    {
        if ($this->categoryList)
            return $this->categoryList;

        $arrItems = $this->select("SELECT DISTINCT c.id AS id FROM category AS c
                                   INNER JOIN partition AS p ON p.category=c.id
                                   INNER JOIN catalog_prod2part AS pp ON pp.partition=p.id
                                   WHERE pp.produce=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Category::initEntityWithId("Category", $item['id']);

        $this->categoryList = $items;

        return $this->categoryList;
    }

    public function setCommentList($commentList)
    {
        $this->commentList = $commentList;
    }

    /* @return ProduceComment[] */
    public function getCommentList()
    {
        if ($this->commentList)
            return $this->commentList;

        $arrItems = $this->select("SELECT id FROM comment
                                   WHERE item=" . $this->id . " AND type=" . CommentType::$toProduce->getCode() .
            " ORDER BY id DESC");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = ProduceComment::initEntityWithId("ProduceComment", $item['id']);

        $this->commentList = $items;

        return $this->commentList;
    }

    public function setSubscriptionList($subscriberList)
    {
        $this->subscriptionList = $subscriberList;
    }

    /* @return SubscriptionItem[] */
    public function getSubscriptionList()
    {
        if ($this->subscriptionList)
            return $this->subscriptionList;

        $arrItems = $this->select("SELECT id FROM subscription
                                   WHERE item=" . $this->id . " AND type='" . SubscriptionType::$toProduce->getCode() . "' ORDER BY id DESC");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = SubscriptionItem::initEntityWithId("SubscriptionItem", $item['id']);

        $this->subscriptionList = $items;

        return $this->subscriptionList;
    }

    public function setDealList($dealList)
    {
        $this->dealList = $dealList;
    }

    public function getDealList()
    {
        if ($this->dealList)
            return $this->dealList;

        $arrItems = $this->select("SELECT DISTINCT deal FROM deal_produce WHERE produce=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Deal::initEntityWithId("Deal", $item['deal']);

        $this->dealList = $items;

        return $this->dealList;
    }

    public function setInProgramList($inProgramList)
    {
        $this->inProgramList = $inProgramList;
    }

    public function getInProgramList()
    {
        if ($this->inProgramList)
            return $this->inProgramList;

        $arrItems = $this->select("SELECT produce FROM catalog_prod2prod
				                         WHERE program=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Produce::initEntityWithId("Produce", $item['produce']);

        $this->inProgramList = $items;

        return $this->inProgramList;
    }

    public function setProgramList($programList)
    {
        $this->programList = $programList;
    }

    /* @return Produce[] */
    public function getProgramList()
    {
        if ($this->programList)
            return $this->programList;

        $arrItems = $this->select("SELECT program FROM catalog_prod2prod WHERE produce=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Produce::initEntityWithId("Produce", $item['program']);

        $this->programList = $items;

        return $this->programList;
    }

    public function setArticleList($articleList)
    {
        $this->articleList = $articleList;
    }

    public function getArticleList()
    {
        if ($this->articleList)
            return $this->articleList;

        $arrItems = $this->select("SELECT article FROM catalog_prod2art WHERE produce=" . $this->id);

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = Article::initEntityWithId("Article", $item['article']);

        $this->articleList = $items;

        return $this->articleList;
    }

    public function setPartitionList($partitionList)
    {
        $this->partitionList = $partitionList;
    }

    public function getPartitionList()
    {
        if ($this->partitionList)
            return $this->partitionList;

        $arrItems = $this->select("SELECT partition FROM catalog_prod2part WHERE produce=" . $this->id . " ORDER BY partition");

        $items = Array();
        foreach ($arrItems as $item)
            $items[] = ProducePartition::initEntityWithId("ProducePartition", $item['partition']);

        $this->partitionList = $items;

        return $this->partitionList;
    }

    public function setAudio($audio)
    {
        $this->audio = $audio;
    }

    public function getAudio()
    {
        return $this->getValueFor("audio");
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->getValueFor("currency");
    }

    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;
    }

    public function getExpiry()
    {
        return $this->getValueFor("expiry");
    }

    public function setGiftAmount($giftAmount)
    {
        $this->giftAmount = $giftAmount;
    }

    public function getGiftAmount()
    {
        return $this->getValueFor("giftAmount");
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->getValueFor("price");
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /* @return ProduceQuantity */
    public function getQuantity()
    {
        return $this->getValueFor("quantity");
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function getRating()
    {
        return $this->getValueFor("rating");
    }

    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    public function getSort()
    {
        return $this->getValueFor("sort");
    }

    public function setSpecialPrice($specialPrice)
    {
        $this->specialPrice = $specialPrice;
    }

    public function getSpecialPrice()
    {
        return $this->getValueFor("specialPrice");
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->getValueFor("title");
    }

    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    public function getVendor()
    {
        return $this->getValueFor("vendor");
    }

    public function setVendorLocation($vendorLocation)
    {
        $this->vendorLocation = $vendorLocation;
    }

    public function getVendorLocation()
    {
        return $this->getValueFor("vendorLocation");
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function getCapacity()
    {
        return $this->getValueFor("capacity");
    }

    public function setDetailList($detailDescription)
    {
        $this->detailList = $detailDescription;
    }

    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    public function getPreview()
    {
        return $this->getValueFor("preview");
    }

    public function getDetailList()
    {
        if ($this->detailList)
            return $this->detailList;

        $this->detailList = $this->getDescriptionList(DetailDescription::$type, "DetailDescription");

        return $this->detailList;
    }

    public function setPreviewList($previewDescription)
    {
        $this->previewList = $previewDescription;
    }

    /* @return Description[] */
    public function getPreviewList()
    {
        if ($this->previewList)
            return $this->previewList;

        $this->previewList = $this->getDescriptionList(PreviewDescription::$type, "PreviewDescription");

        return $this->previewList;
    }

    protected function getDescriptionList($type, $class)
    {
        $arrItems = $this->select("SELECT id FROM catalog_description WHERE produce=" . $this->id . " AND type='" . $type . "' ORDER BY sort ASC");

        $items = Array();
        foreach ($arrItems as $item) {
            /* @var Description $ds */
            $ds = Description::initEntityWithId($class, $item['id']);
            $ds->setProduce($this);

            $items[] = $ds;
        }

        return $items;
    }

    public function persistEntity()
    {
        $this->execute("INSERT INTO catalog (id, price, currency, special_price, vendor, vendor_location,
        title, capacity, expiry, audio, quantity, rating,
		gift_amount, sort, preview) VALUES ("
            . $this->id . ", '"
            . $this->price . "', '"
            . $this->currency . "', '"
            . $this->getSQLValueFor("specialPrice") . "', '"
            . $this->getSQLValueFor("vendor") . "', '"
            . $this->getSQLValueFor("vendorLocation") . "', '"
            . $this->getSQLValueFor("title") . "', '"
            . $this->getSQLValueFor("capacity") . "', '"
            . $this->getSQLValueFor("expiry") . "', '"
            . $this->getSQLValueFor("audio") . "', '"
            . $this->quantity->getCode() . "', '"
            . $this->getSQLValueFor("rating") . "', '"
            . $this->getSQLValueFor("giftAmount") . "', '"
            . $this->getSQLValueFor("sort") . "', '"
            . $this->getSQLValueFor("preview") . "')");

        $this->replacePrograms();
        $this->replaceArticlePrograms();
        $this->replacePartitions();
        $this->replacesDoshes();
    }

    /* @var array $arItem */
    protected function fillEntityByArray($arItem)
    {
        if (isset($arItem['quantity']))
            $this->quantity = ProduceQuantity::getItemBy($arItem['quantity'], "ProduceQuantity");

        $this->setPostedValueFor("price", $arItem['price']);
        $this->setPostedValueFor("currency", $arItem['currency']);
        $this->setPostedValueFor("specialPrice", $arItem['special_price']);
        $this->setPostedValueFor("vendor", $arItem['vendor']);
        $this->setPostedValueFor("vendorLocation", $arItem['vendor_location']);
        $this->setPostedValueFor("title", $arItem['title']);
        $this->setPostedValueFor("capacity", $arItem['capacity']);
        $this->setPostedValueFor("expiry", $arItem['expiry']);
        $this->setPostedValueFor("rating", $arItem['rating']);
        $this->setPostedValueFor("giftAmount", $arItem['gift_amount']);
        $this->setPostedValueFor("sort", $arItem['sort']);
        $this->setPostedValueFor("preview", $arItem['preview']);

        if ($arItem['articles']) {
            $this->articleList = Array();
            foreach ($arItem['articles'] as $itemId)
                $this->articleList[] = Article::initEntityWithId("Article", $itemId);
        }

        if ($arItem['programs']) {
            $this->programList = Array();
            foreach ($arItem['programs'] as $itemId)
                $this->articleList[] = Produce::initEntityWithId("Produce", $itemId);
        }

        if ($arItem['doshes']) {
            $this->dosheEffectList = Array();
            foreach ($arItem['doshes'] as $item)
                $this->dosheEffectList[] = DosheEffect::createForArray($item);
        }

        if ($arItem['partitions']) {
            $this->partitionList = Array();
            foreach ($arItem['partitions'] as $itemId)
                $this->partitionList[] = $this->articleList[] = Partition::initEntityWithId("Partition", $itemId);
        }

        if ($arItem['partition'])
            $this->partitionList[] = ProducePartition::initEntityWithId("ProducePartition", $arItem['partition']);

        if ($arItem['program'])
            $this->programList[] = Produce::initEntityWithId("Produce", $arItem['program']);

        if ($arItem['article'])
            $this->articleList[] = Article::initEntityWithId("Article", $arItem['article']);
    }

    public function updateEntity()
    {
        $this->execute("UPDATE catalog SET"
            . " price='" . $this->price
            . "', currency='" . $this->currency
            . "', special_price='" . $this->getSQLValueFor("specialPrice")
            . "', vendor='" . $this->getSQLValueFor("vendor")
            . "', vendor_location='" . $this->getSQLValueFor("vendorLocation")
            . "', title='" . $this->getSQLValueFor("title")
            . "', capacity='" . $this->getSQLValueFor("capacity")
            . "', expiry='" . $this->getSQLValueFor("expiry")
            . "', quantity='" . $this->quantity->getCode()
            . "', rating='" . $this->getSQLValueFor("rating")
            . "', gift_amount='" . $this->getSQLValueFor("giftAmount")
            . "', sort='" . $this->getSQLValueFor("sort")
            . "', preview='" . $this->getSQLValueFor("preview")
            . "' WHERE id=" . $this->id);

        $this->replacesDoshes();
        $this->replacePrograms();
        $this->replaceArticlePrograms();
        $this->replacePartitions();
    }

    public function removeEntity()
    {
        $this->execute("DELETE FROM catalog WHERE id=" . $this->id);

        $this->removeDescriptions();
        $this->removePartitions();
        $this->removeArticlePrograms();
        $this->removePrograms();
        $this->removeDoshes();
    }

    protected function getRemoveImossibilityReason()
    {
        $response = $this->printList($this->getDealList(), "Produce refered by deals: ", " <br><br> ");
        $response .= $this->printList($this->getInProgramList(), "Produce refered by produces: ", " <br><br> ");
        $response .= $this->printList($this->getArticleList(), "Produce refered by articles: ");

        return $response;
    }

    public function toShortString()
    {
        return $this->getTitle();
    }

    public function toDetailString()
    {
        return $this->getTitle();
    }

    /* @var Produce $item */
    public function removeProgramItem($item)
    {
        $this->setProgramList($item->removeFrom($this->programList));
    }

    /* @var Article $item */
    public function removeArticleProgramItem($item)
    {
        $this->setArticleList($item->removeFrom($this->articleList));
    }

    /* @var Partition $item */
    public function removePartitionItem($item)
    {
        $this->setPartitionList($item->removeFrom($this->partitionList));
    }

    /* @var Description $item */
    public function removeDescriptionItem($item)
    {
        $this->setPreviewList($item->removeFrom($this->previewList));
        $this->setDetailList($item->removeFrom($this->detailList));
    }

    protected function removePrograms()
    {
        $this->execute("DELETE FROM catalog_prod2prod WHERE produce=" . $this->id);
    }

    protected function removeInPrograms()
    {
        $this->execute("DELETE FROM catalog_prod2prod WHERE program=" . $this->id);
    }

    protected function removeArticlePrograms()
    {
        $this->execute("DELETE FROM catalog_prod2art WHERE produce=" . $this->id);
    }

    protected function removePartitions()
    {
        $this->execute("DELETE FROM catalog_prod2part WHERE produce=" . $this->id);
    }

    protected function removeDescriptions()
    {
        $this->execute("DELETE FROM catalog_description WHERE produce=" . $this->id);
    }

    protected function removeDoshes()
    {
        $this->execute("DELETE FROM catalog_doshe WHERE produce=" . $this->id);
    }

    protected function replacePartitions()
    {
        $this->removePartitions();

        foreach ($this->partitionList as $partition)
            $this->execute("INSERT INTO catalog_prod2part (produce, partition) VALUES (" . $this->id . ", " . $partition->getId() . ")");
    }

    protected function replacePrograms()
    {
        $this->removePrograms();

        foreach ($this->programList as $program)
            $this->execute("INSERT INTO catalog_prod2prod (produce, program) VALUES (" . $this->id . ", " . $program->getId() . ")");
    }

    protected function replaceArticlePrograms()
    {
        $this->removeArticlePrograms();

        foreach ($this->articleList as $program)
            $this->execute("INSERT INTO catalog_prod2art (produce, article) VALUES (" . $this->id . ", " . $program->getId() . ")");
    }

    protected function replacesDoshes()
    {
        $this->removeDoshes();

        foreach ($this->dosheEffectList as $dosheEffect) {

            if (EffectDirection::$unknown->equals($dosheEffect->getValue()))
                continue;

            $this->execute("INSERT INTO catalog_doshe (produce, doshe, value) VALUES ("
                . $this->id . ", "
                . $dosheEffect->getDoshe()->getCode() . ", "
                . $dosheEffect->getValue()->getCode() . ")");
        }
    }

    /* @param Category $item */
    public function inCategory($item)
    {
        if ($item->getContainsInIndex($this->getCategoryList()) !== false)
            return true;

        return false;
    }

    /* @param Partition $item */
    public function inPartition($item)
    {
        if ($item->getContainsInIndex($this->getPartitionList()) !== false)
            return true;

        return false;
    }

    /* @return Partition */
    public function inOneOfPartitionList($partitionUrlList)
    {
        foreach ($partitionUrlList as $url) {
            $partiton = ProducePartition::initEntityByUrl($url);

            if ($this->inPartition($partiton))
                return $partiton;
        }

        return ProducePartition::initEntity("ProducePartition");
    }

    public function getPersistTableName()
    {
        return "catalog";
    }

    protected function getPersistImposibilityReason()
    {
        $response = $this->isEmptyValueFor("title");
        $response .= $this->isEmptyValueFor("quantity");
        $response .= $this->isEmptyValueFor("sort");

        $response .= (count($this->partitionList) <= 0) ? "empty produce partitions<BR>" : "";

        return $response;
    }

    protected function initEntityReferencesByIdFromDB()
    {
        $this->setInProgramList(null);
        $this->setProgramList(null);
        $this->setCategoryList(null);
        $this->setPartitionList(null);
        $this->setArticleList(null);
        $this->setDealList(null);
        $this->setCommentList(null);
        $this->setSubscriptionList(null);

        $this->setPreviewList(null);
        $this->setDetailList(null);

        $this->getInProgramList();
        $this->getProgramList();
        $this->getCategoryList();
        $this->getPartitionList();
        $this->getArticleList();
        $this->getDealList();
        $this->getCommentList();
        $this->getSubscriptionList();

        $this->getPreviewList();
        $this->getDetailList();
    }

    /* @param Partition $partition */
    public function createUrlFor($partition = null)
    {
        $p = $partition;
        if ($p == null) {
            $p = $this->getPartitionList();
            $p = $p[0];
        }

        if ($p->getContainsInIndex($this->getPartitionList()) === false)
            return "";

        return "/" . $p->getUrl() . "/" . $this->id . "/";
    }

    public function notifySubscribers()
    {
        $subscriptionList = $this->getSubscriptionList();

        foreach ($subscriptionList as $subscription)
            $subscription->sendNotificationEmail();
    }

    public function isPresence()
    {
        return ProduceQuantity::$presence->equals($this->getQuantity());
    }

    public function isWaiting()
    {
        return ProduceQuantity::$wating->equals($this->getQuantity());
    }

    /* @return Partition
     * @param Subcategory $subcategory
     */
    public function findPartitionBy($subcategory)
    {
        $produceId = $this->id;
        $subcategoryId = $subcategory->getId();

        $result = $this->select("SELECT p.id FROM partition AS p
                       INNER JOIN catalog_prod2part AS pp
                       ON p.id=pp.partition
                       WHERE pp.produce=$produceId AND p.subcategory=$subcategoryId");

        $partitionId = ($result[0]['id']) ? $result[0]['id'] : 0;

        return ProducePartition::initEntityWithId("ProducePartition", $partitionId);
    }
}

;
