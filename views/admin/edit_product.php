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
                            <?php if (isset($success)): ?>
                            <h3><?= $success ?></h3>
                            <?php else: ?>
                            <form action="#" method="post" id="add_product" enctype="multipart/form-data">
                                <input type="hidden" name="p_id" value="<?= $product['product_id'] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_name">Назва товару</label>
                                            <input type="text" id="p_name" name="p_name" class="form-control" placeholder="Назва товару" value="<?= $product['product_name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_category">Категорія</label>
                                            <select id="p_category" name="p_category" class="form-control" required>
                                                <?php foreach($categories as $category): ?>
                                                    <option value="<?= $category['cat_id'] ?>" <?= ($product['category']['parent'] == $category['cat_id'])? 'selected' : '' ?>><?= $category['cat_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_type">Тип</label>
                                            <select id="p_type" name="p_type" class="form-control" required>

                                                <?php foreach($childs as $category): ?>
                                                    <option value="<?= $category['cat_id'] ?>" <?= ($product['category']['cat_id'] == $category['cat_id'])? 'selected' : '' ?>><?= $category['cat_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_brand">Виробник</label>
                                            <select id="p_brand" name="p_brand" class="form-control" required>
                                                <?php foreach($brands as $brand): ?>
                                                    <option value="<?= $brand['brand_id'] ?>" <?= ($product['brand_id'] == $brand['brand_id'])? 'selected' : '' ?>><?= $brand['brand_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="p_old_price">Стара ціна</label>
                                            <input type="number" id="p_old_price" name="p_old_price" class="form-control" placeholder="Стара ціна" required value="<?= $product['price'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="p_new_price">Нова ціна</label>
                                            <input type="number" id="p_new_price" name="p_new_price" class="form-control" placeholder="Нова ціна" required value="<?= $product['new_price'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_country">Країна виробник</label>
                                            <input type="text" id="p_country" name="p_country" class="form-control" placeholder="Країна виробник" required value="<?= $product['country'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="p_img">Зображення:</label>
                                            <input type="file" name="p_img[]" id="p_img" accept="image/*" multiple>
                                            <output id="list"></output>


                                                <?php foreach ($images as $img): ?>
                                                    <a href="<?= $img ?>">
                                                    <div class="preimg">
                                                        <img class="thumb" src="<?= $img ?>" alt="">
                                                    </div>
                                                    </a>
                                                <?php endforeach; ?>

                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="col-md-12">
                                        <label for="p_descr">Опис</label>
                                        <textarea class="form-control" name="p_descr" id="p_descr" cols="30" rows="10" required><?= $product['description'] ?></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="p_sizes">Розміри:</label>
                                            <input class="form-control" type="text" name="p_size_xs" id="p_sizes" value="<?= $p_sizes->XS ?>" placeholder="xs">
                                            <input class="form-control" type="text" name="p_size_s" id="p_sizes" value="<?= $p_sizes->S ?>" placeholder="s">
                                            <input class="form-control" type="text" name="p_size_m" id="p_sizes" value="<?= $p_sizes->M ?>" placeholder="m">
                                            <input class="form-control" type="text" name="p_size_l" id="p_sizes" value="<?= $p_sizes->L ?>" placeholder="l">
                                            <input class="form-control" type="text" name="p_size_xl" id="p_sizes" value="<?= $p_sizes->XL ?>" placeholder="xl">
                                            <input class="form-control" type="text" name="p_size_xxl" id="p_sizes" value="<?= $p_sizes->XXL ?>" placeholder="xxl">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <br>
                                <button type="submit" name="edit_submit" class="btn btn-green">Змінити</button>
                            </form>

                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php include_once(ROOT . '/views/layout/admin_footer.php'); ?>