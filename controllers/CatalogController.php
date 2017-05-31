<?php

include_once(ROOT . '/components/Pagination.php');
include_once(ROOT . '/components/Cart.php');
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');

class CatalogController {

    private $sorted_array;
    
    public function actionCatalog($catAbbr){


        $page = 'catalog';
        
        $catAbbr = strip_tags(trim($catAbbr));
        
        $categories = Category::getCategory();
        $title = Category::getTitle($catAbbr);
        
        require_once(ROOT . '/views/catalog/catalog.php');
        return true; 
        
    }
    

    public function actionCategory($catAbbr, $childAbbr, $page_num=1, $sorting=false){
        $page = 'category';

        $catAbbr = strip_tags(trim($catAbbr));
        $childAbbr = strip_tags(trim($childAbbr));

        $categories = Category::getCategory();
        $title = Category::getTitle($catAbbr);
        $child_title = Category::getTitle($childAbbr);

        $cat_id = Category::getCatId($childAbbr);

        //Pagination
        if(is_string($page_num)){
            $page_num = explode('-', $page_num);
                array_shift($page_num);
            $page_num = $page_num[0];
        }

        if($sorting){

            $this->sorted_array = Category::createSortedArray($sorting);
            $sort_query = Category::createSortQuery($this->sorted_array, $cat_id, $page_num);
            $sort_query = explode(',', $sort_query);
            $sortType = $sort_query[1];
            $sortQuery = $sort_query[0];
            $product_in_category = Category::getProducts($cat_id, $page_num, $sortType, $sortQuery);

        } else {

            $product_in_category = Category::getProducts($cat_id, $page_num);

        }

        if (isset($_GET['price_from'])){

            $value = intval(trim(htmlspecialchars($_GET['price_from'])));

            $link = Category::createSortLink($this->sorted_array, 'price_from', $value);

            echo $link;
            exit();
        } elseif (isset($_GET['price_to'])){

            $value = intval(trim(strip_tags(htmlspecialchars($_GET['price_to']))));

            $link = Category::createSortLink($this->sorted_array, 'price_to', $value);
            echo $link;
            exit();
        }

        $countProducts = isset($sortQuery)? Category::getCountProducts($cat_id, $sortQuery) : Category::getCountProducts($cat_id);

        $pagination = new Pagination($countProducts, $page_num, Category::SHOW_BY_DEFAULT, 'page-');

        $getProductPrice = Category::getProductPrice($product_in_category);
        $max = max($getProductPrice);
        $min = min($getProductPrice);
        $brands = Category::getBrands($cat_id);

        $page_link = '/category/' . $catAbbr . '/' . $childAbbr . '/page-' . $page_num . '/';
        $product_preview = $catAbbr . '/' .  $childAbbr . '/';



        if($countProducts == 1){
            $countProducts .= ' товар';
        } else if ($countProducts == 2){
            $countProducts .= ' товара';
        } else if ($countProducts == 3 || $countProducts == 4){
            $countProducts .= ' товари';
        } else {
            $countProducts .= ' товарів';
        }

        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}

