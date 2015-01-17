<?php
/**
 * Created by PhpStorm.
 * User: ledenev.p
 * Date: 11.06.14
 * Time: 8:35
 */

/* @property Doshe $doshe
 * @property EffectDirection $value;
 */
class DosheEffect
{
    protected $value;
    protected $doshe;

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setDoshe($doshe)
    {
        $this->doshe = $doshe;
    }

    public function getDoshe()
    {
        return $this->doshe;
    }

    /* @param Doshe $doshe */
    public static function createForDoshe($doshe)
    {
        $dosheEffect = new DosheEffect();

        $dosheEffect->setDoshe($doshe);
        $dosheEffect->setValue(EffectDirection::$unknown);

        return $dosheEffect;
    }

    /* @param Array $arr */
    public static function createForArray($arr)
    {
        $dosheEffect = new DosheEffect();

        $dosheEffect->setDoshe(Doshe::getItemBy($arr['doshe'], "Doshe"));
        $dosheEffect->setValue(EffectDirection::getItemBy($arr['value'], "EffectDirection"));

        return $dosheEffect;
    }
} 