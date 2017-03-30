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
                            <h2>Ви справді хочете видалити <?= $product['product_name'] ?> ?</h2>
                            <hr>
                            <form action="#" method="post">
                                <label for="radio_delete">Видалити?</label><br>
                                <div class="form-group">
                                    Так <input type="radio" name="radio_delete" value="yes">
                                </div>
                                <div class="form-group">
                                    Ні &nbsp; <input type="radio" name="radio_delete" value="no" checked>
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-danger" value="Видалити" name="delete_product">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php include_once(ROOT . '/views/layout/admin_footer.php'); ?>