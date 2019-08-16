<?php

class Product {

    
    public static function getProductInfo($id){
        
        $id = intval($id);
        
        $db = Db::GetConnection(); 
        
        $product_info = array();
        
        $sql = "SELECT * FROM products WHERE id = '$id' AND availability='1'";
        $result = $db->query($sql);
        
        if($result->num_rows){
            $product_info = $result->fetch_assoc();
        
            $product_category = self::getProductCategory($product_info['cat_id']);

            $brand = self::getBrand($product_info['brand_id']);

            $product_info['brand_name'] = $brand;
            $product_info['category'] = $product_category;
            
            return $product_info;
        }
        
        return false;
        
    }
    
    public static function getBrand($id){
        $db = Db::GetConnection(); 
        $sql = "SELECT title FROM brands WHERE id = ' $id '";
        $result = $db->query($sql);
        
        $brand = $result->fetch_assoc();

        return $brand['title'];
    }
    
    public static function getSizes($id){

        $db = Db::GetConnection(); 
        
        $sql = "SELECT * FROM product_sizes WHERE product_id = ' $id '";
        $result = $db->query($sql);
        
        $sizes = $result->fetch_assoc();
        $sizes = json_decode($sizes['product_size']);

        return $sizes;
    }
    
    public static function getImages($catAbbr, $childAbbr, $product_id){
        
        $dirPath = 'products/' . $catAbbr . '/' . $childAbbr . '/' . $product_id . '/img';
        
        $images = array();
        if(file_exists($dirPath)){
            $dh = opendir($dirPath);
            while(false !== ($filename = readdir($dh))){
                $images[] = '/' . $dirPath . '/' . $filename;
            }
        } else {
            return false;
        }

        return $images;
    }

    public static function getImagesName($catAbbr, $childAbbr, $product_id){

        $dirPath = 'products/' . $catAbbr . '/' . $childAbbr . '/' . $product_id . '/img';

        $images = array();
        $i = 0;
        if(file_exists($dirPath)){
            $dh = opendir($dirPath);
            while(false !== ($filename = readdir($dh))){
                $images[] = $filename;
            }
        } else {
            return false;
        }


        return $images;
    }
    
    
    
    public static function getProductCategory($cat_id){
        $db = Db::GetConnection();
        
        $sql = "SELECT id, title, abbr, parent FROM categories WHERE id = ' $cat_id '";
        $result = $db->query($sql);
        
        $category = $result->fetch_assoc();
        
        if($category['parent'] != 0){
            $parent = self::getProductCategory($category['parent']);
            $category['parent_name'] = $parent['title'];
            $category['parent_abbr'] = $parent['abbr'];
        }
        
        return $category;
    }
    
}

?>