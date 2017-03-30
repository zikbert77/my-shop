<?php include_once(ROOT . '/views/layout/admin_header.php'); ?>

    <div class="clearfix"></div>
    <div class="container-fluid content">
        <div class="row">

            <?php include_once ROOT . '/views/layout/admin_left_menu.php' ?>

            <div class="col-md-9">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h3><?= $title ?></h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="small-block">
                            <?php

                            if(!empty($errors)){
                                foreach ($errors as $error){
                                    echo '<p class="alert alert-danger">'. $error .'</p>';
                                }
                            }
                            if(isset($success)){
                                echo $success;
                            }
                            ?>
                            <form action="#" method="post" id="add_product" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_name">Назва товару</label>
                                            <input type="text" id="p_name" name="p_name" class="form-control" placeholder="Назва товару" value="<?= isset($p['p_name'])? $p['p_name'] : '' ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_category">Категорія</label>
                                            <select id="p_category" name="p_category" class="form-control" required>
                                                <?php foreach($categories as $category): ?>
                                                    <option value="<?= $category['cat_id'] ?>"<?= (isset($p['p_category']) && ($p['p_category'] == $category['cat_id']))? 'selected' : '' ?>><?= $category['cat_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_type">Тип</label>
                                            <select id="p_type" name="p_type" class="form-control" required>
                                                <?php foreach($childs as $category): ?>
                                                    <option value="<?= $category['cat_id'] ?>" <?= (isset($p['p_type']) && ($p['p_type'] == $category['cat_id']))? 'selected' : '' ?>><?= $category['cat_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_brand">Виробник</label>
                                            <select id="p_brand" name="p_brand" class="form-control" required>
                                                <?php foreach($brands as $brand): ?>
                                                    <option value="<?= $brand['brand_id'] ?>" <?= (isset($p['p_brand']) && ($p['p_brand'] == $brand['brand_id']))? 'selected' : '' ?>><?= $brand['brand_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_old_price">Ціна </label>
                                            <input type="number" id="p_price" name="p_price" class="form-control" value="<?= isset($p['p_price'])? $p['p_price'] : '' ?>" placeholder="Ціна" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_country">Країна виробник</label>
                                            <input type="text" id="p_country" name="p_country" class="form-control" value="<?= isset($p['p_country'])? $p['p_country'] : '' ?>" placeholder="Країна виробник" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_img">Зображення:</label>
                                            <input type="file" name="p_img[]" id="p_img" accept="image/*" multiple>
                                            <output id="list"></output>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="col-md-12">
                                        <label for="p_descr">Опис</label>
                                        <textarea class="form-control" name="p_descr" id="p_descr" cols="30" rows="10" required><?= isset($p['p_descr'])? $p['p_descr'] : 'Опис' ?></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_sizes">Розміри:</label>
                                            <input class="form-control" type="text" name="p_size_xs" id="p_sizes1"  value="<?= isset($sizes['XS'])? $sizes['XS'] : '0' ?>" placeholder="xs">
                                            <input class="form-control" type="text" name="p_size_s" id="p_sizes2"   value="<?= isset($sizes['S'])? $sizes['S'] : '0' ?>" placeholder="s">
                                            <input class="form-control" type="text" name="p_size_m" id="p_sizes3"   value="<?= isset($sizes['M'])? $sizes['M'] : '0' ?>" placeholder="m">
                                            <input class="form-control" type="text" name="p_size_l" id="p_sizes4"   value="<?= isset($sizes['L'])? $sizes['L'] : '0' ?>" placeholder="l">
                                            <input class="form-control" type="text" name="p_size_xl" id="p_sizes5"  value="<?= isset($sizes['XL'])? $sizes['XL'] : '0' ?>" placeholder="xl">
                                            <input class="form-control" type="text" name="p_size_xxl" id="p_sizes6  " value="<?= isset($sizes['XXL'])? $sizes['XXL'] : '0' ?>" placeholder="xxl">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <hr>
                                <button type="submit" name="add_submit" class="btn btn-green">Додати</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php include_once(ROOT . '/views/layout/admin_footer.php'); ?>