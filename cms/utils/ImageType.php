<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 08.08.13
 * Time: 8:44
 * To change this template use File | Settings | File Templates.
 */

class ImageType extends Enum
{
    public static $catalog;
    public static $catalog2;
    public static $articleDetail;
    public static $articlePreview;
    public static $sertificate;
    public static $category;
    public static $category2;
    public static $subcategory;
    public static $partition;
    public static $description;
    public static $cliparts;
    public static $tops;
    public static $promotionDetail;
    public static $promotionPreview;
    public static $unknown;

    public static function enumerate()
    {
        self::$catalog = new ImageType("catalog", "Изображение");
        self::$catalog2 = new ImageType("catalog2", "Модуль");
        self::$articlePreview = new ImageType("article_preview", "Изображение для анонса");
        self::$articleDetail = new ImageType("article_detail", "Изображение для статьи");
        self::$sertificate = new ImageType("sertificate", "Сертификат");
        self::$category = new ImageType("catalog_category", "Изображение неактивное");
        self::$category2 = new ImageType("catalog_category2", "Изображение активное");
        self::$subcategory = new ImageType("catalog_subcategory", "Изображение");
        self::$partition = new ImageType("catalog_partition", "Изображение");
        self::$description = new ImageType("description", "Изображение");
        self::$cliparts = new ImageType("cliparts", "Изображение");
        self::$tops = new ImageType("tops", "Изображение для топа");
        self::$promotionDetail = new ImageType("promotion_detail", "Иконка акции в деталях товара");
        self::$promotionPreview = new ImageType("promotion_preview", "Иконка акции в превью товара");
        self::$unknown = new ImageType("unknown", "Неопределен");
    }
}

;