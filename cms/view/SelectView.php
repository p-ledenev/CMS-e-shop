<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 26.08.13
 * Time: 8:53
 * To change this template use File | Settings | File Templates.
 */

/* @property PersistableEntity $entity */
class SelectView extends View
{
    private $formName;
    private $fieldName;
    private $displayFieldName;
    private $entity;

    public function __construct($formName, $fieldName, $entity, $displayFieldName = null)
    {
        $this->formName = $formName;
        $this->fieldName = $fieldName;
        $this->entity = $entity;
        $this->displayFieldName = $displayFieldName;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    public function getFieldName()
    {
        return $this->fieldName;
    }

    public function setFormName($formName)
    {
        $this->formName = $formName;
    }

    public function getFormName()
    {
        return $this->formName;
    }

    public function setDisplayFieldName($displayFieldName)
    {
        $this->displayFieldName = $displayFieldName;
    }

    public function getDisplayFieldName()
    {
        return $this->displayFieldName;
    }

    protected function echoHeaderTemplate()
    {
    }

    protected function  echoFooterTemplate()
    {
    }

    protected function echoBodyTemplate()
    {
        include "selectView.phtml";
    }
}

;