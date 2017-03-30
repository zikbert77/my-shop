<?php

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 14.03.2017
 * Time: 16:11
 */
class Search
{
    public static function searchByPattern($pattern){

        $products = [];

        $db = Db::getConnection();

        $sql = "SELECT * FROM products WHERE product_name LIKE '%$pattern%' ORDER BY date DESC";
        $result = $db->query($sql);

        $i = 0;
        while($row = $result->fetch_assoc()){

            $products[$i]['product_id'] = $row['product_id'];
            $products[$i]['product_name'] = $row['product_name'];
            $products[$i]['product_parent_category'] = Category::getCatAbbr(Category::getCatParent($row['cat_id']));
            $products[$i]['product_category'] = Category::getCatAbbr($row['cat_id']);
            $products[$i]['product_price'] = $row['price'];
            $products[$i]['product_old_price'] = $row['old_price'];
            $products[$i]['product_brand'] = Product::getBrand($row['brand_id']);
            $i++;
        }


        return $products;
    }
}