<?php

class Admin {
    public static function getAllProducts($sort=false){
        $db = Db::getConnection();

        if($sort){
           if ($sort=='low_price'){
               $sortType = 'ORDER by price ASC';
           } elseif ($sort == 'high_price'){
               $sortType = 'ORDER by price DESC';
           } elseif ($sort == 'asc_name'){
               $sortType = 'ORDER by product_name ASC';
           } elseif ($sort == 'desc_name'){
               $sortType = 'ORDER by product_name DESC';
           } elseif ($sort=='low_id'){
               $sortType = 'ORDER by product_id ASC';
           } elseif ($sort=='high_id'){
               $sortType = 'ORDER by product_id DESC';
           }  else {
               $sortType = 'ORDER by date ASC';
           }

            $sql = "SELECT * FROM products ".$sortType;
        } else {
            $sql = "SELECT * FROM products";
        }
        $result = $db->query($sql);

        $productList = array();
        $i = 0;

        while($row = $result->fetch_assoc()){
            $productList[$i]['product_id'] = $row['product_id'];
            $productList[$i]['product_name'] = $row['product_name'];
            $productList[$i]['product_price'] = $row['price'];
            $productList[$i]['product_old_price'] = $row['old_price'];
            $productList[$i]['product_category'] = Category::getTitle(Category::getCatAbbr($row['cat_id']));

            $i++;
        }

        return $productList;

    }
    public static function getCategory(){
        $db = Db::getConnection();

        $sql = "SELECT * FROM categories WHERE parent=0";
        $result = $db->query($sql);

        $cat = array();
        $i = 0;

        while($row = $result->fetch_assoc()){
            $cat[$i]['cat_id'] = $row['cat_id'];
            $cat[$i]['cat_name'] = $row['cat_name'];
            $i++;
        }

        return $cat;

    }

    public static function getCategoryChilds($p_id){
        $db = Db::getConnection();

        $sql = "SELECT * FROM categories WHERE parent='$p_id'";
        $result = $db->query($sql);

        $cat = array();
        $i = 0;

        while($row = $result->fetch_assoc()){
            $cat[$i]['cat_id'] = $row['id'];
            $cat[$i]['cat_name'] = $row['title'];
            $i++;
        }

        return $cat;
    }

    public static function getBrands(){
        $db = Db::getConnection();

        $sql = "SELECT * FROM brands";
        $result = $db->query($sql);

        $cat = array();
        $i = 0;

        while($row = $result->fetch_assoc()){
            $cat[$i]['brand_id'] = $row['id'];
            $cat[$i]['brand_name'] = $row['brand_name'];
            $i++;
        }

        return $cat;
    }

    public static function getUserByThisMonth(){
        $db = Db::getConnection();

        $sql = "select id from users where date_format(created_at, '%Y%m%d') = date_format(now(), '%Y%m%d')";

        $result = $db->query($sql);
        $i = 0;
        while($row = $result->fetch_assoc()){
            $i++;
        }

        return $i;
    }

    public static function getLastID(){
        $db = Db::getConnection();

        $sql = "SELECT product_id FROM products ORDER BY product_id DESC";
        $result = $db->query($sql);
        $id = $result->fetch_assoc();

        return $id['product_id'];
    }

    public static function getLastCode(){
        $db = Db::getConnection();

        $sql = "SELECT code FROM products ORDER BY code DESC";
        $result = $db->query($sql);
        $code = $result->fetch_assoc();

        return $code['code'];
    }

    public static function getProductCode($id){
        $db = Db::getConnection();

        $sql = "SELECT code FROM products WHERE product_id='$id'";
        $result = $db->query($sql);
        $code = $result->fetch_assoc();

        return $code['code'];
    }

    public static function checkProductName($name){
        $db = Db::getConnection();

        $sql = "SELECT product_name FROM products WHERE product_name='$name'";
        $result = $db->query($sql);

        if($result->num_rows > 0){
            return false;
        }

        return true;
    }

    public static function addProduct($product_info){
        $db = Db::getConnection();

        $sql = "INSERT INTO products(product_name, cat_id, code, price, brand_id, country, description, date) " .
        "VALUES('{$product_info['p_name']}', '{$product_info['p_type']}', '{$product_info['p_code']}', '{$product_info['p_price']}', " .
            "'{$product_info['p_brand']}', '{$product_info['p_country']}', '{$product_info['p_descr']}', NOW())";
        $result = $db->query($sql) or die('Erorr to add product');
        $id = $db->insert_id;
        if($id != 0){
            return $id;
        }
        return false;
    }

    public static function addSizes($size, $id){
        $db = Db::getConnection();

        $size = json_encode($size);

        $sql = "INSERT INTO product_sizes(product_id, product_size) VALUES ('$id', '$size')";
        $result = $db->query($sql) or die('Erorr to add size');

        return true;
    }

    public static function deleteProduct($product_id){
        $db = Db::getConnection();

        $sql = "DELETE FROM products WHERE product_id='$product_id'";
        $result = $db->query($sql) or die('Error to delete product');

        return true;
    }

    public static function deleteSize($product_id){
        $db = Db::getConnection();

        $sql = "DELETE FROM product_sizes WHERE product_id='$product_id'";
        $result = $db->query($sql) or die('Error to delete size');

        return true;
    }

    public static function updateProduct($product_info){
        $db = Db::getConnection();

        $sql = "UPDATE products SET product_name='{$product_info['p_name']}', cat_id='{$product_info['p_type']}', code='{$product_info['p_code']}', ".
        "price='{$product_info['p_new_price']}', old_price='{$product_info['p_old_price']}', brand_id='{$product_info['p_brand']}', ".
        "country='{$product_info['p_country']}', description='{$product_info['p_descr']}' WHERE product_id='{$product_info['p_id']}'";

        $result = $db->query($sql) or die('Error to update product');

        return false;
    }

    public static function updateSizes($size, $p_id){
        $db = Db::getConnection();
        $size = json_encode($size);

        $sql = "UPDATE product_sizes SET product_size='$size' WHERE product_id='$p_id'";

        $result = $db->query($sql) or die('Error to update sizes');

        return false;
    }
}