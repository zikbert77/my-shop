<?php

include_once(ROOT . '/models/User.php');
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author zikbe
 */
class UserController
{


    public function actionProfile()
    {

        if (isset($_SESSION['u_id'])) {
            $title = 'Профіль користувача ' . $_SESSION['u_name'];

            $user_info = User::getUserInfo($_SESSION['u_id']);
            $user_orders = User::getOrdersByID($user_info['id']);

            //echo $user_orders[0]['order_info']->user_phone;

            require_once ROOT . '/views/user/profile.php';
        } else {
            header("Location: /");
        }

        return true;
    }

    public function actionLogin()
    {
        if (!(isset($_SESSION['u_id']))) {
            if (isset($_POST['l_submit'])) {
                $email = trim(htmlspecialchars($_POST['l_email']));
                $pass = trim(htmlspecialchars($_POST['l_pass']));

                $pass = md5($pass);

                $user = User::getUser($email, $pass);

                if ($user) {
                    $_SESSION['u_id'] = $user['id'];
                    $_SESSION['u_name'] = $user['name'];
                    if ($user['status'] == 1) {
                        $_SESSION['admin_id'] = $user['id'];
                    }
                    header("Location: /");
                } else {
                    $errors[] = 'Введено направильні дані.';
                }

            }

            require_once ROOT . '/views/user/login.php';

        } else {
            header("Location: /");
        }
        return true;
    }

    public function actionLogout()
    {

        if ((isset($_SESSION['u_id']) || isset($_SESSION['u_name']))) {
            unset($_SESSION['u_id']);
            unset($_SESSION['u_name']);
            if (isset($_SESSION['admin_id'])) {
                unset($_SESSION['admin_id']);
            }
            $referer = trim(htmlspecialchars($_SERVER['HTTP_REFERER']));
            header("Location: $referer");
        } else {
            $referer = trim(htmlspecialchars($_SERVER['HTTP_REFERER']));
            header("Location: $referer");
        }
        return true;
    }

    public function actionRegister()
    {

        if (!(isset($_SESSION['u_id']))) {
            if (isset($_POST['r_submit'])) {

                $name = trim(htmlspecialchars($_POST['r_name']));
                $email = trim(htmlspecialchars($_POST['r_email']));
                $pass1 = trim(htmlspecialchars($_POST['r_pass1']));
                $pass2 = trim(htmlspecialchars($_POST['r_pass2']));

                $errors = false;

                if ($pass1 != $pass2) {
                    $errors[] = 'Паролі не співпадають';
                }

                if (!User::validateName($name)) {
                    $errors[] = 'Ім\'я повинно бути менше 20 символів';
                }

                if (!User::validateEmail($email)) {
                    $errors[] = 'Некоректно введено email';
                }

                if (!User::checkEmailExist($email)) {
                    $errors[] = 'Такий email уже існує';
                }

                if (!User::validatePassRegister($pass1)) {
                    $errors[] = 'Пароль має мати хоча б 1 букву';
                }

                if (strlen($pass1) < 5) {
                    $errors[] = 'Пароль має мати бути більше 5 символів';
                }

                if (!$errors) {
                    if (User::userRegister($name, $email, $pass1)) {
                        header('Refresh: 3; URL=' . '/user/login/');
                        $success = '<br><p class="br-success"><b>' . $name . '</b> вас успішно зареєстровано.</p><br /><span>Через 3 секунди вас буде перенаправлено на сторінку входу.</span>';
                    } else {
                        $success = '<p class="br-warning">Помилка реєстрації, спробуйте пізніше!</p>';
                    }
                }

            }

            require_once ROOT . '/views/user/register.php';

        } else {
            header("Location: /");
        }
        return true;
    }


}
