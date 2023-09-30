<?php

namespace App\Controller\ShopNoSql;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Shop\Shop;
use App\Model\Shop\Item;
use App\Model\Shop\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop_no_sql', name: 'shop_nosql_')]
class ShopController extends AbstractController
{
    private $shop;

    public function __construct (Shop $shop)
    {
        $this->shop = $shop;
    }

    #[Route('/shop', name: 'index')]
    public function shopAction () : Response
    {
        $products = json_decode(file_get_contents('./data/products.json'), true);
        $this->initShop($products);
        $htmlArbo = '<ul class="list-group">';
        $this->createHTMLArborescence($this->shop->getMainCategory()->getChildren(), $htmlArbo);
        $htmlArbo .= '</ul class="list-group">';
//        dump($htmlArbo);
        return $this->render('shopNoSql/shop_no_sql.html.twig', ['shop' => $this->shop, 'htmlArbo' => $htmlArbo]);
    }

    public function addItemAction ()
    {

    }

    public function removeItemAction ()
    {

    }

    public function search ()
    {

    }

    private function initShop ($arrayProducts)
    {
        $items = $arrayProducts['products']['data']['items'];

        foreach($items as $item) {
            $categories = explode('/', $item['category']);
            $parent = $this->shop->getMainCategory();
            $this->createArborescence($categories, $parent);
        }
    }

    private function createArborescence($categories, $parent)
    {
        foreach($categories as $key => $category) {
            $isExists = false;
            foreach($parent->getChildren() as $cat){
                if($cat->getName() === $category){
                    $isExists = true;
                }
            }

            if(!$isExists){
                $newCategory = new Category($category);
                $parent->addChild($newCategory);
                $newCategory->setParent($parent);
                $parent = $newCategory;
            } else {
                $parent = $parent->getChild($category);
            }
        }
    }

    private function createHTMLArborescence($categories, &$htmlArbo)
    {
        foreach ($categories as $category) {
            $htmlArbo .= '<li class="list-group-item">'. $category->getName() .'</li>';

            if (!empty($category->getChildren())) {
                $htmlArbo .= '<ul class="list-group">';
                $this->createHTMLArborescence($category->getChildren(), $htmlArbo);
                $htmlArbo .= '</ul>';
            }
        }
    }
}