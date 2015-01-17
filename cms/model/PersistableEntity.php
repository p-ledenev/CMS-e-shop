<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 07.08.13
 * Time: 8:41
 * To change this template use File | Settings | File Templates.
 */

/* @property Repository $base; */
abstract class PersistableEntity
{
    public static $base;

    protected $id;
    protected $loaded;

    /* @return PersistableEntity $entity */
    public static function initEntityWithNewId($className)
    {
        /* @var PersistableEntity $entity */
        $entity = new $className();
        $entity->setNewId();

        return $entity;
    }

    /* @return PersistableEntity $entity */
    public static function initEntityWithId($className, $id)
    {
        /* @var PersistableEntity $entity */
        $entity = new $className();
        $entity->setId($id);

        return $entity;
    }

    /* @return PersistableEntity $entity */
    public static function initEntity($className)
    {
        /* @var PersistableEntity $entity */
        $entity = new $className();

        return $entity;
    }

    public function __construct()
    {
        $this->loaded = false;
        $this->id = -27;
    }

    public function setLoaded($loaded)
    {
        $this->loaded = $loaded;
    }

    public function getLoaded()
    {
        return $this->loaded;
    }

    public function setBase($base)
    {
        $this->base = $base;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function initEntityById()
    {
        $this->loaded = true;

        $arItem = $this->select("SELECT * FROM " . $this->getPersistTableName() . " WHERE id=" . $this->id);

        if (!$arItem || count($arItem) <= 0)
            return;

        $this->fillEntityByArray($arItem[0]);
    }

    public function initEntityByIdWithReferences()
    {
        $this->initEntityById();
        $this->initEntityReferencesByIdFromDB();
    }

    public function fillEntityBy($arItem)
    {
        $this->initEntityById();

        $this->fillEntityByArray($arItem);
    }

    public function removeEntitySafly()
    {
        if ($this->isRemovePossible())
            $this->removeEntity();
    }

    public function persistEntitySafly()
    {
        if ($this->isPersistPossible())
            $this->persistEntity();
    }

    public function updateEntitySafly()
    {
        if ($this->isUpdatePossible())
            $this->updateEntity();
    }

    private function getNextEnumerator()
    {
        $enumerator = $this->select("SHOW TABLE STATUS LIKE 'enumerator'");
        $enumerator = $enumerator[0]['Auto_increment'];

        $this->execute("ALTER TABLE enumerator AUTO_INCREMENT=" . ($enumerator + 1));

        return $enumerator;
    }

    /* @var PersistableEntity[] $itemList
     * @return string
     */
    protected function printList($itemList, $head, $foot = "")
    {
        if (count($itemList) <= 0)
            return "";

        $response = $head;
        foreach ($itemList as $item)
            $response .= $item->toShortString() . ", ";
        $response .= $foot;

        return $response;
    }

    public function select($data)
    {
        return PersistableEntity::$base->select($data);
    }

    protected function execute($query)
    {
        return PersistableEntity::$base->executeSecure($query);
    }

    /* @param PersistableEntity[] $itemList */
    public function removeFrom($itemList)
    {
        $ind = $this->getContainsInIndex($itemList);

        if ($ind !== false)
            array_splice($itemList, $ind, 1);

        return $itemList;
    }

    /* @param PersistableEntity[] $itemList */
    public function getContainsInIndex($itemList)
    {
        foreach ($itemList as $key => $item)
            if ($this->equals($item))
                return $key;

        return false;
    }

    /* @param PersistableEntity $entity
     * @return bool
     */
    public function equals($entity)
    {
        if (!$entity)
            return false;

        if ($this->id == $entity->getId())
            return true;

        return false;
    }

    public function getValueFor($property)
    {
        if ($this->loaded === true || isset($this->$property)) {
            return $this->$property;
        }

        $this->initEntityById();

        return $this->$property;
    }

    protected function setPropertyFor($name, $value)
    {
        $this->$name = $value;
    }

    public function getSQLValueFor($property)
    {
        if ($this->getValueFor($property))
            return htmlentities($this->getValueFor($property), ENT_QUOTES, "cp1251");

        return "";
    }

    protected function setPostedValueFor($property, $value)
    {
        if (!isset($value))
            return;

        $this->setPropertyFor($property, $value);
    }

    protected function isEmptyValueFor($property)
    {
        if (is_null($this->$property) || (is_string($this->$property) && strlen(trim($this->$property)) <= 0))
            return "$property is empty<BR>";

        return "";
    }

    protected function isRemovePossible()
    {
        $response = $this->getRemoveImossibilityReason();

        return $this->throwExceptionFor($response);
    }

    protected function isPersistPossible()
    {
        $response = $this->getPersistImposibilityReason();

        return $this->throwExceptionFor($response);
    }

    protected function isUpdatePossible()
    {
        $response = $this->getUpdateImposibilityReason();

        return $this->throwExceptionFor($response);
    }

    private function throwExceptionFor($response)
    {
        if (strlen($response) > 0)
            throw new Exception($response);

        return true;
    }

    public function setNewId()
    {
        $this->id = $this->getNextEnumerator();
    }

    public function isPersisted()
    {
        if ($this->id <= 0)
            return false;

        $arItem = $this->select("SELECT id FROM " . $this->getPersistTableName() . " WHERE id=" . $this->id);

        if (count($arItem) > 0)
            return true;

        return false;
    }

    public function reLoad()
    {
        $this->loaded = false;
        $this->initEntityById();
    }

    public function reLoadWithReferences()
    {
        $this->loaded = false;
        $this->initEntityByIdWithReferences();
    }

    protected function randString($length = 10)
    {
        $allchars = "abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789";
        $string = "";

        for ($i = 0; $i < $length; $i++)
            $string .= $allchars[mt_rand(0, strlen($allchars) - 1)];

        return $string;
    }

    public static function initEntityByUrl($className, $url)
    {
        /* @var PersistableEntity $item */
        $item = new $className;
        $tableName = $item->getPersistTableName();

        $result = PersistableEntity::$base->select("SELECT id FROM $tableName WHERE url='$url'");

        if ($result != null)
            return PersistableEntity::initEntityWithId($className, $result[0]['id']);

        return PersistableEntity::initEntity($className);
    }

    protected function getUpdateImposibilityReason()
    {
        return $this->getPersistImposibilityReason();
    }

    /* @var array $arItem */
    abstract protected function fillEntityByArray($arItem);

    abstract public function persistEntity();

    abstract public function updateEntity();

    abstract public function removeEntity();

    protected abstract function getRemoveImossibilityReason();

    abstract protected function getPersistImposibilityReason();

    protected abstract function initEntityReferencesByIdFromDB();

    public abstract function toShortString();

    public abstract function toDetailString();

    abstract public function getPersistTableName();
}

;