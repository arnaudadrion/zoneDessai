<?php

namespace App\Model\Shop;

class Shop
{
    private $mainCategory;

    public function __construct()
    {
        $this->mainCategory = new Category('shop');
    }

    public function &getMainCategory() : Category
    {
        return $this->mainCategory;
    }

    public function setMainCategory($mainCategory) {
        $this->mainCategory = $mainCategory;
    }
}