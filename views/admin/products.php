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
                            <table class="table table-bordered">
                                <caption>Перелік товарів</caption>
                                <tr class="active">
                                    <td><a href="<?= isset($_GET['sort'])? ($_GET['sort'] == 'low_id')? '?sort=high_id' : '?sort=low_id' : '?sort=low_id' ?>">ID</a></td>
                                    <td><a href="<?= isset($_GET['sort'])? ($_GET['sort'] == 'asc_name')? '?sort=desc_name' : '?sort=asc_name' : '?sort=asc_name' ?>">Назва</a></td>
                                    <td>Категорія</td>
                                    <td><a href="<?= isset($_GET['sort'])? ($_GET['sort'] == 'low_price')? '?sort=high_price' : '?sort=low_price' : '?sort=low_price' ?>"> Ціна </a></td>
                                    <td>Стара ціна</td>
                                    <td>Дії</td>
                                </tr>
                                <?php foreach ($product_list as $product): ?>
                                    <tr>
                                        <td><?= $product['product_id'] ?></td>
                                        <td><a href="/product/<?= $product['product_id'] ?>/"><?= $product['product_name'] ?></a></td>
                                        <td><?= $product['product_category'] ?></td>
                                        <td><?= $product['product_price'] ?></td>
                                        <td><?= $product['product_old_price'] ?></td>
                                        <td class="text-center">
                                            <a href="/admin/product/edit/<?= $product['product_id'] ?>/" title="Редагувати товар"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            &nbsp;
                                            <a href="/admin/product/delete/<?= $product['product_id'] ?>/" title="Видалити товар"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php include_once(ROOT . '/views/layout/admin_footer.php'); ?>