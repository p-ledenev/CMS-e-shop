<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 26.02.14
 * Time: 8:31
 */

class Captcha
{
    protected $key;

    public function __construct()
    {
        $this->generateKey();
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function generateKey($length = 6)
    {
        $this->key = "";

        for ($i = 0; $i < $length; $i++) {

            $r1 = round(rand(1, 2));
            if ($r1 == 1) $ltr = chr(round(rand(48, 57)));
            elseif ($r1 == 2) $ltr = chr(round(rand(65, 90)));
            else $ltr = chr(round(rand(97, 122)));

            $this->key .= $ltr;
        }
    }

    public function createImage()
    {
        $this->generateKey();

        $keyWidth = 25;
        $width = strlen($this->key) * $keyWidth;
        $img = imagecreatetruecolor($width, 30);
        $col = imagecolorallocate($img, 255, 255, 255);
        imagefill($img, 1, 1, $col);

        foreach (str_split($this->key) as $i => $value)
            imagettftext($img, $keyWidth, 0, ($i * $keyWidth), 24, 0, $_SERVER['DOCUMENT_ROOT'] . '/fonts/Hortensia.ttf', $value);

        return imagepng($img);
    }

    public function validate($key)
    {
        if (!$key || strlen($key) == 0) return false;

        if (!$this->key || strlen($this->key) == 0) return false;

        return (strtolower($this->key) == strtolower($key));
    }

} 