<?php

class User
{
    public static function getUser($email, $pass)
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            return $user;
        }

        return false;
    }

    public static function getUserInfo($id)
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            return $user;
        }

        return false;
    }

    public static function getOrdersByID($id)
    {
        $orders = array();

        $db = Db::getConnection();

        $sql = "SELECT * FROM orders WHERE id='$id' ORDER BY order_date DESC";
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $orders[$i]['order_id'] = $row['id'];
            $orders[$i]['order_info'] = json_decode($row['order_info']);
            $orders[$i]['order_date'] = $row['order_date'];
            $orders[$i]['order_status'] = $row['order_status'];
            $orders[$i]['order_ttn'] = $row['order_ttn'];

            $i++;
        }

        return $orders;
    }

    public static function validateName($name)
    {
        if (strlen($name) < 25) {
            return true;
        }

        return false;
    }

    public static function validatePhoneLen($phone)
    {
        if (strlen($phone) == 10) {
            return true;
        }

        return false;
    }

    public static function validatePhone($phone)
    {
        if (preg_match("/([0-9]+)/", $phone)) {
            return true;
        }

        return false;
    }

    public static function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public static function checkEmailExist($email)
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $db->query($sql);

        if ($result->num_rows == 0) {
            return true;
        }

        return false;
    }

    public static function validatePassRegister($pass)
    {
        if (preg_match("/[a-zA-Z]/", $pass)) {
            return true;
        }

        return false;
    }


    public static function userRegister($name, $email, $pass)
    {
        $db = Db::getConnection();

        $pass = md5($pass);

        $sql = "INSERT INTO users(first_name, email, pass, created_at) VALUES('$name', '$email', '$pass', NOW())";
        $result = $db->query($sql) or die(mysql_error($db));

        return true;
    }

}
