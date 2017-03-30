<?php include_once(ROOT . '/views/layout/header.php'); ?>
    <div class="clearfix"></div>


    <div class="container-fluid content">

        <div class="row">
            <div class="col-md-12 hidden-xs">
                <ol class="breadcrumb">
                    <li><a href="/"> Головна</a></li>
                    <li class="active">Пошук</li>
                </ol>
            </div>
        </div>

    <div class="row">

        <div class="col-md-9 col-md-offset-1 col-main">
            <div class="main" style="border-right: 1px solid #ccc;">
                <div class="row">
                    <div class="col-md-12">
                        <h3><?= '<small> &nbsp;  '. $countProducts .'</small>'; ?> </h3>
                        <hr />
                        <span>Сортувати: </span>
                        <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'low_price') ?>">Найнижча ціна</a> |
                        <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'high_price') ?>">Найвища ціна</a> |
                        <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'new') ?>">Найновіші</a> |
                        <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'old') ?>">Старі</a>

                        <div class="goods">
                            <div class="row">

                                <?php if(!empty($products)): ?>


                                    <?php foreach($products as $product): ?>

                                        <div class="col-good-container col-lg-3 col-xs-12 col-sm-6">
                                            <div class="good-container">
                                                <div class="stock">
                                                    <?php
                                                    if(!empty($product['product_old_price'])){
                                                        echo '<span class="label label-warning">Знижка</span>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="good-img">
                                                    <img src="/products/<?php echo $product['product_parent_category'] . '/' .  $product['product_category'] . '/' . $product['product_id'] . '/img/IMG_' .$product['product_id'] . '_0.jpg' ; ?>" alt="Фото <?php echo $product['product_name']; ?>">
                                                </div>
                                                <div class="good-price">
                                                    <?php
                                                    if(!empty($product['product_old_price'])){
                                                        echo '<span class="old-price">'. $product['product_old_price'] . ' грн. </span>
                                                                          <span class="new-price"> &nbsp;'. $product['product_price'] .' грн.</span>';
                                                    } else {
                                                        echo '<span class="old-price"> </span>
                                                                          <span class="new-price">'. $product['product_price'] .' грн.</span>';
                                                    }
                                                    ?>
                                                    <br><br>
                                                </div>
                                                <div class="good-footer">
                                                    <span class="short-name" title="<?php echo $product['product_name']; ?>"><?php echo substr($product['product_name'], 0, 50) . ' / '; ?></span>
                                                    <span class="good-brand" title="Виробник: <?php echo $product['product_brand']; ?>"><?php echo $product['product_brand']; ?></span>

                                                    <br><br>
                                                    <a href="/product/<?php echo $product['product_id'] . '/'; ?>" class="btn
                                                                <?php if(Cart::checkProduct($product['product_id'])){
                                                        echo 'btn-success';
                                                    }else {
                                                        echo 'btn-primary';

                                                    } ?> btn-block">

                                                        <?php if(Cart::checkProduct($product['product_id']))
                                                        {
                                                            echo ' Куплено <i class="fa fa-check" aria-hidden="true"></i></a>';

                                                        } else {
                                                            echo 'Детальніше</a>';

                                                        } ?>

                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                    <?php else: ?>

                                    <center><h2>Вибачте, але за запитом <u><i><?= $q ?></i></u> нічого не знайдено</h2></center>

                                <?php endif; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <p id="test"></p>
    </div>
    </div>
<?php include_once(ROOT . '/views/layout/footer.php'); ?>