<?php
include_once(ROOT . '/models/Product.php');

class Category
{
    const SHOW_BY_DEFAULT = 12;

    public static function getCategory()
    {
        $db = Db::getConnection();

        $categoryList = array();

        $sql = "SELECT * FROM categories WHERE status='1'";
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['title'] = $row['title'];
            $categoryList[$i]['abbr'] = $row['abbr'];
            $categoryList[$i]['parent'] = $row['parent'];
            if ($row['img'] != null) {
                $categoryList[$i]['image'] = $row['img'];
            }
            $i++;
        }

        $cat = Category::getChild($categoryList);
        $count_cat_list = count($categoryList);
        $count_cat = count($cat);
        for ($i = 0; $i < $count_cat_list; $i++) {
            foreach ($cat as $key => $value) {
                if (($categoryList[$i]['id'] == $key) && !empty($value)) {
                    $categoryList[$i]['child'] = $value;
                }
            }
        }

        return $categoryList;
    }

    public static function getChild($categoryList)
    {

        $parentsIds = array();
        $parents = array();
        $childs = array();

        //Визначаємо батьків
        foreach ($categoryList as $key => $category) {
            if ($category['parent'] == 0) {
                $parentsIds[] = $category['id'];
            }
        }

        //Визначаємо дітей
        $count_parent = count($parentsIds);
        $count_category = count($categoryList);

        for ($i = 0; $i < $count_parent; $i++) {

            $parents[$i] = array();

            for ($j = 0; $j < $count_category; $j++) {
                if ($parentsIds[$i] == $categoryList[$j]['parent']) {
                    array_push($parents[$i], $categoryList[$j]['abbr']);
                }
            }

        }

        $final = array_combine($parentsIds, $parents);

        for ($i = 0; $i < count($final); $i++) {

            if (!empty($final[$i])) {
                array_flip($final[$i]);
            }

        }

        return $final;
    }

    public static function getTitle($catAbbr)
    {
        $db = Db::getConnection();

        $sql = "SELECT title FROM categories WHERE status='1' AND abbr='$catAbbr'";
        $result = $db->query($sql);

        $title = $result->fetch_assoc();

        return $title['title'];
    }

    public static function getCatId($cat_abbr)
    {
        $db = Db::getConnection();

        $sql = "SELECT id FROM categories WHERE abbr='$cat_abbr'";
        $result = $db->query($sql);

        $cat_id = $result->fetch_assoc();

        return $cat_id['id'];
    }

    public static function getCatAbbr($cat_id)
    {
        $db = Db::getConnection();

        $sql = "SELECT cat_abbr FROM categories WHERE id='$cat_id'";
        $result = $db->query($sql);

        $cat_abbr = $result->fetch_assoc();

        return $cat_abbr['cat_abbr'];
    }

    public static function getCatParent($cat_id)
    {
        $db = Db::getConnection();

        $sql = "SELECT parent FROM categories WHERE id='$cat_id'";
        $result = $db->query($sql);

        $cat_abbr = $result->fetch_assoc();

        return $cat_abbr['parent'];
    }

    public static function getProducts($cat_id, $page = 1, $sortType = false, $sort_query = '')
    {

        $max_products = intval(self::SHOW_BY_DEFAULT);
        $page = intval($page);
        $offset = ($page - 1) * $max_products;
        $db = Db::getConnection();
        if ($sortType) {
            if ($sortType == 'low_price') {
                $sorting = ' ORDER BY price ASC';
            } elseif ($sortType == 'high_price') {
                $sorting = ' ORDER BY price DESC';
            } elseif ($sortType == 'new') {
                $sorting = ' ORDER BY date DESC';
            } elseif ($sortType == 'old') {
                $sorting = ' ORDER BY date ASC';
            } else {
                $sorting = ' ORDER BY date ASC';
            }
            if (!empty($sort_query)) {
                $sql = "SELECT * FROM products WHERE $sort_query AND id='$cat_id'" . $sorting . " LIMIT $max_products OFFSET $offset";
            } else {
                $sql = "SELECT * FROM products WHERE id='$cat_id'" . $sorting . " LIMIT $max_products OFFSET $offset";
            }
        } else {
            if (!empty($sort_query)) {
                $sql = "SELECT * FROM products WHERE $sort_query AND id='$cat_id' ORDER BY date DESC LIMIT $max_products OFFSET $offset";
            } else {
                $sql = "SELECT * FROM products WHERE id='$cat_id' ORDER BY date DESC LIMIT $max_products OFFSET $offset";
            }
        }
        $count_sql = "SELECT count(product_id) as count FROM products WHERE id='$cat_id'";
        $result = $db->query($sql);

        $productList = array();
        $i = 0;

        while ($row = $result->fetch_assoc()) {
            $productList[$i]['product_id'] = $row['product_id'];
            $productList[$i]['product_name'] = $row['product_name'];
            $productList[$i]['product_price'] = $row['price'];
            $productList[$i]['product_old_price'] = $row['old_price'];
            $productList[$i]['product_brand'] = Product::getBrand($row['brand_id']);
            $productList[$i]['product_brand_id'] = $row['brand_id'];
            $i++;
        }
        return $productList;
    }

    public static function getCountProducts($cat_id, $sortQuery = false)
    {

        $db = Db::getConnection();

        if ($sortQuery) {
            $sql = "SELECT count(product_id) as count FROM products WHERE $sortQuery AND id='$cat_id'";
        } else {
            $sql = "SELECT count(product_id) as count FROM products WHERE id='$cat_id'";
        }

        $result = $db->query($sql);

        $total = $result->fetch_assoc();
        $total = $total['count'];
        return $total;
    }

    public static function getBrands($catId)
    {


        $db = Db::getConnection();

        $sql = "SELECT brand_id FROM products WHERE id='$catId'";

        $result = $db->query($sql);

        while ($row = $result->fetch_assoc()) {
            $brands[] = $row['brand_id'];
        }

        $brands = array_unique($brands);
        sort($brands);
        return $brands;
    }

    public static function getProductPrice($products)
    {
        $price = array();

        foreach ($products as $product) {
            if ($product['product_old_price'] == 0) {
                array_push($price, $product['product_price']);
            } else {
                array_push($price, $product['product_old_price']);
            }
        }

        return $price;
    }

    public static function getMaxPrice($products)
    {
        $max = max($products);

        return $max;
    }

    public static function createSortedArray($sorting)
    {

        $segments = explode(';', $sorting);
        $segments = array_diff($segments, ['']);
        $sorted_array = [];

        for ($i = 0; $i < count($segments); $i++) {

            for ($i = 0; $i < count($segments); $i++) {
                $segment_item[$i] = explode('=', $segments[$i]);

                if ($segment_item[$i][0] != 'sort') {
                    if (preg_match("/[\,]/", $segment_item[$i][1])) {
                        $sorted_array[$segment_item[$i][0]] = explode(',', $segment_item[$i][1]);
                    } else {
                        $sorted_array[$segment_item[$i][0]][] = $segment_item[$i][1];
                    }
                } else {
                    $sorted_array[$segment_item[$i][0]] = $segment_item[$i][1];
                }


            }
        }

        foreach ($sorted_array as $key => $item) {
            if (preg_match("/[\?]/", $key)) {
                unset($sorted_array[$key]);
            }
        }


        return $sorted_array;
    }

    public static function createSortQuery($sorted_array, $cat_id, $page_num)
    {

        $sort_query_array = [];
        $sort_query = '';


        foreach ($sorted_array as $key => $value) {
            if ($key != 'sort') {
                if ($key == 'brand_id') {
                    $sort_query .= ' (brand_id=\'';
                    $sort_query .= implode('\' OR brand_id=\'', $value);
                    $sort_query .= '\')';
                    $sort_query_array[] = $sort_query;
                    $sort_query = '';

                } elseif ($key == 'price_to') {

                    $sort_query .= 'price <= \'' . $value[0] . '\'';
                    $sort_query_array['price'][1] = $sort_query;
                    $sort_query = '';

                } elseif ($key == 'price_from') {

                    $sort_query .= 'price >= \'' . $value[0] . '\'';
                    $sort_query_array['price'][0] = $sort_query;
                    $sort_query = '';

                } else {
                    exit();
                }
            }
        }

        if (isset($sort_query_array['price'])) {
            $sort_query_array[] = '(' . implode(' AND ', $sort_query_array['price']) . ')';
            unset($sort_query_array['price']);
        }

        $sort_query = implode(' AND ', $sort_query_array);

        if (isset($sorted_array['sort'])) {
            $sortType = $sorted_array['sort'];
        } else {
            $sortType = 'new';
        }

        return $sort_query . ',' . $sortType;
    }

    public static function createSortLink($sort_array = false, $type, $value)
    {

        $url = false;

        if ($sort_array) {

            if (!isset($sort_array[$type])) {
                $sort_array[$type] = $value;
            } else {
                if ($type == 'sort') {
                    $pattern = ['/low_price/', '/high_price/', '/new/', '/old/'];
                    $sort_array[$type] = preg_replace($pattern, $value, $sort_array[$type]);

                } elseif ($type == 'brand_id') {


                    if (isset($sort_array['brand_id']) && !empty($sort_array['brand_id']) && in_array($value,
                            $sort_array['brand_id'])) {

                        for ($i = 0; $i < count($sort_array['brand_id']); $i++) {
                            if ($sort_array['brand_id'][$i] === $value) {
                                unset($sort_array['brand_id'][$i]);
                            }
                        }

                        if (empty($sort_array['brand_id'])) {
                            unset($sort_array['brand_id']);
                        }

                    } else {

                        if (!is_array($sort_array['brand_id'])) {

                            $sort_array['brand_id'] = [];
                            $sort_array['brand_id'][] = $value;

                        } else {

                            $sort_array['brand_id'][] = $value;
                            $sort_array['brand_id'] = array_diff($sort_array['brand_id'], ['']);
                        }

                    }

                    if (isset($sort_array['brand_id']) && !empty($sort_array['brand_id'])) {
                        $sort_array['brand_id'] = array_unique($sort_array['brand_id']);
                    }


                } else {
                    $sort_array[$type] = $value;
                }
            }


            foreach ($sort_array as $key => $value) {
                if (is_array($value)) {
                    $url .= $key . '=' . implode(',', $value) . ';';
                } else {
                    $url .= $key . '=' . $value . ';';
                }

            }

            $url .= (!empty($sort_array)) ? '/' : '';
        } else {
            $url .= $type . '=' . $value . ';/';
        }

        $url = preg_replace('/[\r\n\t]/', '', $url);

        return $url;
    }

}

