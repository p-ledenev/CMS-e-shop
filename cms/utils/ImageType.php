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
        self::$catalog = new ImageType("catalog", "�����������");
        self::$catalog2 = new ImageType("catalog2", "������");
        self::$articlePreview = new ImageType("article_preview", "����������� ��� ������");
        self::$articleDetail = new ImageType("article_detail", "����������� ��� ������");
        self::$sertificate = new ImageType("sertificate", "����������");
        self::$category = new ImageType("catalog_category", "����������� ����������");
        self::$category2 = new ImageType("catalog_category2", "����������� ��������");
        self::$subcategory = new ImageType("catalog_subcategory", "�����������");
        self::$partition = new ImageType("catalog_partition", "�����������");
        self::$description = new ImageType("description", "�����������");
        self::$cliparts = new ImageType("cliparts", "�����������");
        self::$tops = new ImageType("tops", "����������� ��� ����");
        self::$promotionDetail = new ImageType("promotion_detail", "������ ����� � ������� ������");
        self::$promotionPreview = new ImageType("promotion_preview", "������ ����� � ������ ������");
        self::$unknown = new ImageType("unknown", "�����������");
    }
}

;