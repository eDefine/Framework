<?php

namespace Entity;

use Edefine\Framework\Entity\AbstractEntity;

class Category extends AbstractEntity
{
    private $name;
    private $parent;
    private $parentId;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;

        if ($parent) {
            $this->setParentId($parent->getId());
        }

        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getTableName()
    {
        return 'category';
    }

    public function getMappedFields()
    {
        return [
            'id',
            'name',
            'parentId'
        ];
    }
}