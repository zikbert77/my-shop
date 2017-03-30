<?php

require_once ROOT . '/components/NP.php';
require_once ROOT . '/models/Admin.php';
require_once(ROOT . '/models/Category.php');
require_once(ROOT . '/models/User.php');
require_once(ROOT . '/models/Product.php');

class AdminController {
    public function actionMain(){
        $title = 'Загальна інформація';
        $page = 'admin_main';
        if(isset($_SESSION['admin_id'])){
            $total_space =  round(disk_total_space("/") / 1000000000);
            $free_space  =  $total_space - round(disk_free_space("/") / 1000000000);

            $userByThisDay = Admin::getUserByThisMonth();

            require_once(ROOT . '/views/admin/admin.php');
        } else {
            header("Location: /");
        }
        return true;
    }

    public function actionAddProduct(){
        $title = 'Додати товар';
        $page = 'add_product';
        if(isset($_SESSION['admin_id'])){

            $categories = Admin::getCategory();
            $childs = Admin::getCategoryChilds(1);
            $brands = Admin::getBrands();

            $code = Admin::getLastCode();
            $code += 1;

            if (isset ($_POST['add_submit'])){
                $p = array();
                $p['p_name'] = addslashes(htmlspecialchars($_POST['p_name']));
                $p['p_category'] = htmlspecialchars($_POST['p_category']);
                $p['p_type'] = htmlspecialchars($_POST['p_type']);
                $p['p_brand'] = htmlspecialchars($_POST['p_brand']);
                $p['p_price'] = htmlspecialchars($_POST['p_price']);
                $p['p_country'] = htmlspecialchars($_POST['p_country']);
                $p['p_descr'] = addslashes(htmlspecialchars($_POST['p_descr']));
                $p['p_code'] = $code;

                $sizes = array();
                $sizes['XS']  = htmlspecialchars($_POST['p_size_xs']);
                $sizes['S']   = htmlspecialchars($_POST['p_size_s']);
                $sizes['M']   = htmlspecialchars($_POST['p_size_m']);
                $sizes['L']   = htmlspecialchars($_POST['p_size_l']);
                $sizes['XL']  = htmlspecialchars($_POST['p_size_xl']);
                $sizes['XXL'] = htmlspecialchars($_POST['p_size_xxl']);

                $errors = false;

                if(!Admin::checkProductName($p['p_name'])){
                    $errors[] = 'Така назва уже існує';
                }

                if(!$errors){
                    $id = Admin::addProduct($p);
                    Admin::addSizes($sizes, $id);

                    $parent_cat = Category::getCatAbbr($p['p_category']);
                    $child_cat  = Category::getCatAbbr($p['p_type']);

                    $uploaddir = ROOT . '/products/'.$parent_cat.'/'.$child_cat.'/'.$id.'/img/';

                    if(!is_file($uploaddir)){
                        $createdir = ROOT . '/products/'.$parent_cat.'/'.$child_cat.'/'.$id;
                        if(mkdir($createdir)){
                            mkdir($uploaddir);
                        } else {
                            echo '<br>dir not created';
                        }
                    }

                    if(file_exists($uploaddir)){

                        foreach ($_FILES["p_img"]["error"] as $key => $error) {
                            if ($error == UPLOAD_ERR_OK) {
                                $tmp_name = $_FILES["p_img"]["tmp_name"][$key];
                                // basename() может спасти от атак на файловую систему;
                                // может понадобиться дополнительная проверка/очистка имени файла
                                $err = false;
                                $fileType = $_FILES['p_img']['type'][$key];
                                if($fileType == 'image/jpeg'){
                                    $type = 'jpg';
                                } elseif ($fileType == 'image/png'){
                                    $type = 'png';
                                } else {
                                    $err = true;
                                }
                                $counter = $key;
                                $oldName = basename($_FILES["p_img"]["name"][$key]);
                                $newName = "IMG_{$id}_{$counter}.{$type}";
                                $name = $uploaddir . $newName;
                                if(!$err){
                                    move_uploaded_file($tmp_name, $name);
                                }
                            }
                        }
                    } else {
                        echo 'dir not found';
                    }
                    header('Refresh: 3; URL='.'/admin/products/');
                    $success = '<p class="alert alert-success">Товар успішно додано</p>';

                }

            }

            require_once(ROOT . '/views/admin/add_product.php');
        } else {
            header("Location: /");
        }

        return true;
    }

    public function actionProducts(){
        $title = 'Редагування товарів';
        $page = 'all_products';
        if(isset($_SESSION['admin_id'])){
            if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
                $product_list = Admin::getAllProducts($sort);
            } else{
                $product_list = Admin::getAllProducts();
            }

          require_once(ROOT . '/views/admin/products.php');
        } else {
            header("Location: /");
        }

        return true;
    }

    public function actionEditProduct($id){
        $title = 'Редагування товарів';
        $page = 'edit';
        if(isset($_SESSION['admin_id'])){

            $product = Product::getProductInfo($id);
            $p_sizes = Product::getSizes($id);
            $code = Admin::getProductCode($id);

            $categories = Admin::getCategory();
            $childs = Admin::getCategoryChilds($product['category']['parent']);
            $brands = Admin::getBrands();

            $images = Product::getImages($product['category']['parent_abbr'], $product['category']['cat_abbr'], $product['product_id']);
            $imagesName = Product::getImagesName($product['category']['parent_abbr'], $product['category']['cat_abbr'], $product['product_id']);

            if($images){
                array_shift($images);
                array_shift($images);
            }

            if(isset($_POST['edit_submit'])){
                $p = array();
                $p['p_id'] = addslashes(htmlspecialchars($_POST['p_id']));
                $p['p_name'] = addslashes(htmlspecialchars($_POST['p_name']));
                $p['p_category'] = htmlspecialchars($_POST['p_category']);
                $p['p_type'] = htmlspecialchars($_POST['p_type']);
                $p['p_brand'] = htmlspecialchars($_POST['p_brand']);
                $p['p_old_price'] = htmlspecialchars($_POST['p_old_price']);
                $p['p_new_price'] = htmlspecialchars($_POST['p_new_price']);
                $p['p_country'] = htmlspecialchars($_POST['p_country']);
                $p['p_descr'] = addslashes(htmlspecialchars($_POST['p_descr']));
                $p['p_code'] = $code;

                $sizes = array();
                $sizes['XS']  = htmlspecialchars($_POST['p_size_xs']);
                $sizes['S']   = htmlspecialchars($_POST['p_size_s']);
                $sizes['M']   = htmlspecialchars($_POST['p_size_m']);
                $sizes['L']   = htmlspecialchars($_POST['p_size_l']);
                $sizes['XL']  = htmlspecialchars($_POST['p_size_xl']);
                $sizes['XXL'] = htmlspecialchars($_POST['p_size_xxl']);

                $errors = false;

                /*//Upload images
                $uploaddir = ROOT . '/products/'.$product['category']['parent_abbr'].'/'.$product['category']['cat_abbr'].'/'.$product['product_id'].'/img/';

                foreach ($_FILES["p_img"]["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["p_img"]["tmp_name"][$key];
                        // basename() может спасти от атак на файловую систему;
                        // может понадобиться дополнительная проверка/очистка имени файла
                        $err = false;
                        $fileType = $_FILES['p_img']['type'][$key];
                        echo $fileType;
                        if($fileType == 'image/jpeg'){
                            $type = 'jpg';
                        } elseif ($fileType == 'image/png'){
                            $type = 'png';
                        } else {
                            $err = true;
                        }
                        $counter = $key;
                        $oldName = basename($_FILES["p_img"]["name"][$key]);
                        $newName = "IMG_{$product['product_id']}_{$counter}.{$type}";
                        $name = $uploaddir . $newName;
                        if(!$err){
                            move_uploaded_file($tmp_name, $name);
                        }
                    }
                }*/

                if(!$errors){
                   Admin::updateProduct($p);
                   Admin::updateSizes($sizes, $p['p_id']);
                   header('Refresh: 2; URL='.'/admin/products/');
                   $success = '<p class="bg-success">Інформацію успішно оновлена</p>';
                }
            }

            require_once(ROOT . '/views/admin/edit_product.php');
        } else {
            header("Location: /");
        }

        return true;
    }

    public function actionAjaxCategory(){
        if(isset($_GET['parent'])){
            $parent = $_GET['parent'];
            $childs = Admin::getCategoryChilds($parent);
            echo json_encode($childs);
        }
        return true;
    }

    public function actionDeleteProduct($id){
        $title = 'Редагування товарів';
        $page = 'delete_product';
        if(isset($_SESSION['admin_id'])){

            $product = Product::getProductInfo($id);

            if(isset($_POST['delete_product'])){

                $val = $_POST['radio_delete'];

                if($val == 'yes'){
                    //Delete product
                    Admin::deleteProduct($product['product_id']);
                    Admin::deleteSize($product['product_id']);
                    header('Location: /admin/products/');
                    $product_dir = ROOT . '/products/'.$product['category']['parent_abbr'].'/'.$product['category']['cat_abbr'].'/'.
                        $product['product_id'].'/';
                    $imgdir = ROOT . '/products/'.$product['category']['parent_abbr'].'/'.$product['category']['cat_abbr'].'/'.
                        $product['product_id'].'/img/';
                    if(is_dir($imgdir)){
                        if ($dh = opendir($imgdir)) {
                            while (($file = readdir($dh)) !== false) {
                                $img = $imgdir . $file;
                                echo $img;
                                if(is_file($img)){
                                    unlink($img);
                                } else {
                                    echo('ads');
                                }

                            }
                            closedir($dh);
                        }
                    }
                    if(rmdir($imgdir)){
                        echo '+';
                    }
                    if(rmdir($product_dir)){
                        echo '+';
                    }

                }


                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
            }

            require_once(ROOT . '/views/admin/delete_product.php');
        } else {
            header("Location: /");
        }

        return true;
    }
}