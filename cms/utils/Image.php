<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 23.08.13
 * Time: 15:20
 * To change this template use File | Settings | File Templates.
 */

/* @property ImageType $type */
class Image
{
    public static $extensions = Array("jpg", "png", "gif");
    public static $serverPath;
    public static $webPath;

    private $name;
    private $type;
    private $title;
    private $urlToEntity;

    /* @param ImageType $type */
    public static function getRandomImageFor($type)
    {
        $files = glob(Image::$serverPath . $type->getCode() . "/*.*");
        $file = array_rand($files);

        $fileName = explode(".", basename($files[$file]));

        return new Image($fileName[0], $type);
    }

    /* @param ImageType $type */
    public static function getConstantRandomImageFor($type, $id)
    {
        $files = glob(Image::$serverPath . $type->getCode() . "/*.*");
        $maxValue = count($files);

        $fileIndex = self::findValueFor($id, $maxValue);
        $fileName = explode(".", basename($files[intval($fileIndex)]));

        return new Image($fileName[0], $type);
    }

    public static function findValueFor($value, $maxValue)
    {
        if ($value < $maxValue)
            return $value;

        return self::findValueFor(substr($value, 1), $maxValue);
    }

    public function __construct($name, $type, $title = null, $urlToEntity = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->title = $title;
        $this->urlToEntity = $urlToEntity;
    }

    public function setUrlToEntity($urlTo)
    {
        $this->urlToEntity = $urlTo;
    }

    public function getUrlToEntity()
    {
        return $this->urlToEntity;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setName($id)
    {
        $this->name = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getFileName($ext = null)
    {
        if ($ext)
            return $this->getName() . ".$ext";

        foreach (Image::$extensions as $extension)
            if ($this->imageExist($extension))
                return $this->getName() . ".$extension";

        return false;
    }

    public function getFileExtension()
    {
        foreach (Image::$extensions as $extension)
            if ($this->imageExist($extension))
                return $extension;

        return false;
    }

    public function getFullPath($extension = null)
    {
        return Image::$serverPath . $this->type->getCode() . "/" . $this->getFileName($extension);
    }

    public function getThumbPath($extension = null)
    {
        return Image::$serverPath . $this->type->getCode() . "/thumb/" . $this->getFileName($extension);
    }

    public function getSourcePath($extension = null)
    {
        return Image::$serverPath . $this->type->getCode() . "/source/" . $this->getFileName($extension);
    }

    public function getFullUrl()
    {
        return Image::$webPath . $this->type->getCode() . "/" . $this->getFileName();
    }

    public function getSourceUrl()
    {
        return Image::$webPath . $this->type->getCode() . "/source/" . $this->getFileName();
    }

    public function getThumbUrl()
    {
        return Image::$webPath . $this->type->getCode() . "/thumb/" . $this->getFileName();
    }

    public function saveImageFrom($arFiles, $image)
    {
        if (strlen($arFiles[$image]["name"]) <= 0)
            return;

        $flname = $arFiles[$image]["tmp_name"];
        $flsize = $arFiles[$image]["size"];

        $extension = strtolower(substr($arFiles[$image]["name"], -3));

        if (!in_array($extension, Image::$extensions))
            throw new Exception("Недопустимый формат изображения <br> Поддерживаются jpg, png, gif");

        if ($flsize > 1024 * 1024)
            throw new Exception("Недопустимый размер изображения <br> Поддерживаются файлы до 1Мб");

        $this->removeImage();

        move_uploaded_file($flname, $this->getSourcePath($extension));

        $this->copyWithReziseTo($this->getThumbPath($extension), 150);
        $this->copyWithReziseTo($this->getFullPath($extension), 400);
    }

    protected function copyWithReziseTo($fileName, $width)
    {
        copy($this->getSourcePath(), $fileName);
        $this->resizeImage($fileName, $width);
    }

    public function removeImage()
    {
        foreach (Image::$extensions as $extension) {

            if ($this->imageExist($extension)) {

                unlink($this->getSourcePath($extension));
                unlink($this->getFullPath($extension));
                unlink($this->getThumbPath($extension));
            }
        }
    }

    public function exist()
    {
        $m = false;
        foreach (Image::$extensions as $extension)
            if ($this->imageExist($extension))
                $m = true;

        return $m;
    }

    protected function imageExist($extension)
    {
        if (file_exists($this->getSourcePath($extension)))
            return true;

        return false;
    }

    private function resizeImage($fileName, $width)
    {
        $extension = $this->getFileExtension();

        switch ($extension) {
            case "jpg" :
                $source = imagecreatefromjpeg($fileName);
                break;
            case "gif" :
                $source = imagecreatefromgif($fileName);
                break;
            case "png" :
                $source = imagecreatefrompng($fileName);
                break;
        }

        $destSX = $width;
        $destSY = round($destSX / imageSX($source) * imageSY($source));

        list($srcW, $srcH) = getimagesize($fileName);

        if ($srcW < $destSX && $srcH < $destSY) {
            $destSX = $srcW;
            $destSY = $srcH;
        }

        $dest = imagecreatetruecolor($destSX, $destSY);

        switch ($extension) {
            case "jpg" :
                imagecopyresampled($dest, imagecreatefromjpeg($fileName), 0, 0, 0, 0, $destSX, $destSY, $srcW, $srcH);
                imagejpeg($dest, $fileName);
                break;

            case "gif" :
                $imgif = imagecreatefromgif($fileName);
                $dest = $this->fillImage($imgif, $dest, $destSX, $destSY, $srcW, $srcH);
                imagegif($dest, $fileName);
                break;

            case "png" :
                $impng = imagecreatefrompng($fileName);
                imagealphablending($dest, false);
                imagealphablending($dest, false);
                imagesavealpha($dest, true);
                $dest = $this->fillImage($impng, $dest, $destSX, $destSY, $srcW, $srcH);
                imagepng($dest, $fileName);
                break;
        }
    }

    private function fillImage($source, $dest, $destSX, $destSY, $srcW, $srcH)
    {
        $originaltransparentcolor = imagecolortransparent($source);
        if ($originaltransparentcolor >= 0 && $originaltransparentcolor < imagecolorstotal($source)) {
            $transparentcolor = imagecolorsforindex($source, $originaltransparentcolor);
            $newtransparentcolor = imagecolorallocate($dest, $transparentcolor['red'], $transparentcolor['green'], $transparentcolor['blue']);

            imagefill($dest, 0, 0, $newtransparentcolor);
            imagecolortransparent($dest, $newtransparentcolor);
        }

        imagecopyresampled($dest, $source, 0, 0, 0, 0, $destSX, $destSY, $srcW, $srcH);

        return $dest;
    }
}

;