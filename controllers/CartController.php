<?php

include_once ROOT . '/components/Cart.php';
include_once ROOT . '/components/NP.php';
require_once(ROOT . '/models/Category.php');
require_once(ROOT . '/models/User.php');
require_once(ROOT . '/models/Product.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartController
 *
 * @author Bogdan
 */
class CartController
{
    public function actionCart()
    {

        $title = 'Корзина';

        $products_in_cart = array();

        if (isset($_SESSION['products'])) {
            $products_in_cart = $_SESSION['products'];
        }

        $total = Cart::getTotalPrice();

        require_once(ROOT . '/views/cart/cart.php');
        return true;

    }

    public function actionConfirm()
    {

        if (isset($_SESSION['products']) && !empty($_SESSION['products']) && isset($_SESSION['u_id'])) {

            $page = 'confirm';
            $products_in_cart = $_SESSION['products'];

            if (isset($_SESSION['u_id'])) {
                $user_info = User::getUserInfo($_SESSION['u_id']);
            }

            if (isset($_POST['confirm-ok'])) {

                $user_name = trim(strip_tags(htmlspecialchars($_POST['user-name'])));
                $user_surname = trim(strip_tags(htmlspecialchars($_POST['user-surname'])));
                $user_phone = trim(strip_tags(htmlspecialchars($_POST['user-phone'])));
                $area = trim(strip_tags(htmlspecialchars($_POST['district'])));
                $city = trim(strip_tags(htmlspecialchars($_POST['city'])));
                $warehouse = trim(strip_tags(htmlspecialchars($_POST['warehouse'])));
                $pay_method = trim(strip_tags(htmlspecialchars($_POST['pay'])));
                $total_count = trim(strip_tags(htmlspecialchars($_POST['total'])));

                $errors = false;

                if (!User::validateName($user_name)) {
                    $errors[] = 'Ім\'я повинне бути менше 25 символів';
                }

                if (!User::validateName($user_surname)) {
                    $errors[] = 'Фамілія повинна бути менше 25 символів';
                }

                if (!User::validatePhoneLen($user_phone)) {
                    $errors[] = 'Номер телефону повинен мати 10 цифр! (Наприклад: 0501234567)';
                }

                if (!User::validatePhone($user_phone)) {
                    $errors[] = 'Номер телефону повинен складатися лише з чисел';
                }

                if (!$errors) {

                    $order = array();
                    $order['user_phone'] = $user_phone;
                    $order['area'] = $area;
                    $order['city'] = $city;
                    $order['warehouse'] = $warehouse;
                    $order['pay_method'] = $pay_method;
                    $order['products'] = $products_in_cart;
                    $order['total'] = $total_count;

                    if (Cart::createOrder($user_info['u_id'], $order)) {
                        unset($_SESSION['products']);
                        header('Refresh: 3; URL=' . '/user/profile/');
                        $success = 'Успішно оформлено, очікуйте дзвінка нашого менеджера, або номер експрес накладної!';

                    }
                }

            }

            $areasAll = NP::getAreas();
            $areas = Cart::sortAreas($areasAll->data);
            $cities = '';

            $title = 'Підтвердження замовлення';

            $totalPrice = Cart::getTotalPrice();
            $totalCount = Cart::getTotalCount();

            if ($totalCount == 1) {
                $totalCount .= ' товар ';
            } else {
                if ($totalCount == 2 || $totalCount == 3 || $totalCount == 4) {
                    $totalCount .= ' товари ';
                } else {
                    $totalCount .= ' товарів ';
                }
            }

            require_once(ROOT . '/views/cart/confirm.php');
        } else {
            header("Location: /cart/");
        }
        return true;

    }

    public function actionAjaxCity()
    {
        $citiesAll = NP::getCity();
        if (isset($_GET['area'])) {
            $district = trim(htmlspecialchars($_GET['area']));
            $cities = Cart::sortCities($citiesAll->data, $district);
            echo json_encode($cities);
        }
        return true;
    }


    public function actionAjaxWarehouse()
    {
        if (isset($_GET['city'])) {
            $city = trim(htmlspecialchars($_GET['city']));
            $warehouseAll = NP::getWarehouse($city);
            $warehouse = Cart::sortWarehouse($warehouseAll->data);
            echo json_encode($warehouse);
        }
        return true;
    }

    public function actionAdd()
    {

        $products_in_cart = array();

        if (isset($_SESSION['products'])) {
            $products_in_cart = $_SESSION['products'];
        }

        if (isset($_POST)) {
            if (array_key_exists($_POST['product_id'], $products_in_cart)) {
                $products_in_cart[$_POST['product_id']]['count'] += 1;
            } else {
                $products_in_cart[$_POST['product_id']]['count'] = 1;
                $products_in_cart[$_POST['product_id']]['size'] = $_POST['product_size'];
                $products_in_cart[$_POST['product_id']]['price'] = $_POST['product_price'];
                $products_in_cart[$_POST['product_id']]['name'] = $_POST['product_name'];
                $products_in_cart[$_POST['product_id']]['cat_abbr'] = $_POST['cat_abbr'];
                $products_in_cart[$_POST['product_id']]['parent_abbr'] = $_POST['parent_abbr'];
            }

            $_SESSION['products'] = $products_in_cart;


            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
        }

        return true;

    }

    public function actionDeleteCart()
    {

        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");


        return true;

    }

    public function actionDeleteFromCart($id)
    {

        if (isset($_SESSION['products'])) {
            $id = intval($id);
            Cart::deleteProduct($id);

        }
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");


        return true;

    }

}
