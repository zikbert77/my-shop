<?php

include_once(ROOT . '/components/Pagination.php');
include_once(ROOT . '/components/Search.php');
include_once(ROOT . '/components/Cart.php');
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');

class SiteController {

    private $sorted_array;
    
    
    public function actionIndex(){
        
        
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionSearch($query = false){

        if (isset($_POST['search']) && isset($_POST['q'])){

            $title = 'Search';
            $page_link = '/search/';

            $q = trim(strip_tags(htmlspecialchars($_POST['q'])));

            $products = Search::searchByPattern($q);
            $countProducts = 'Знайдено ' . count($products) . ' товарів';

            require_once(ROOT . '/views/site/search.php');
        } else {
            $referer = (isset($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER'] : '/';

            header("Location: $referer");
            exit(0);
        }



        return true;
    }
    
    
}