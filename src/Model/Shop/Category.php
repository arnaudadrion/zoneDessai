<?php

namespace App\Model\Shop;

use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    private $name;

    private $children;

    private $parent;

    public function __construct ($name)
    {
        $this->name = $name;
        $this->children = [];
    }

    public function getName ()
    {
        return $this->name;
    }

    public function addChild (Category $category)
    {
        $this->children[] = $category;
    }

    public function getChildren () : array
    {
        return $this->children;
    }

    public function getChild ($name) : Category|null
    {
        foreach ($this->getChildren() as $category) {
            if ($category->getName() === $name) {
                return $category;
            }
        }

        return null;
    }

    public function setParent (Category $parent)
    {
        $this->parent = $parent;
    }

    public function getParent () : Category
    {
        return $this->parent;
    }
}