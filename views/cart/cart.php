<?php include_once(ROOT . '/views/layout/header.php'); ?>

<div class="container-fluid content">

      
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="main" style="border-right: 1px solid #ccc;">
                  <h1>Корзина</h1>
                  <hr>
                  
                   <div class="goods">
                      <?php if(empty($products_in_cart)): ?>
                       <center><h3>У корзині немає товарів</h3></center>
                       <hr />
                      <?php else: ?>
                       
                      <?php foreach($products_in_cart as $key => $product): ?>
                       
                        <div class="media">
                            <div class="media-left">
                                <a href="/product/<?php echo $key; ?>">
                                    
                                    <?php $images = Product::getImages($product['parent_abbr'], $product['cat_abbr'], $key); ?>
                                    <img class="media-object" src="<?php echo $images[2];  ?>" alt="...">
                                </a>
                            </div>
                            <div class="media-body">

                                <div class="row">
                                    <div class="col-md-10 col-xs-7">
                                        <h4 class="media-heading"><?php echo $product['name']; ?></h4>
                                        <span>
                                            Кількість: <?php echo $product['count']; ?>, Розмір: <?php echo $product['size']; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-2 col-xs-5 text-center to-trash">
                                        <a href="/cart/unset/<?php echo $key;?>">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                        <p>
                                            <span><?php echo ($product['price'] * $product['count']) ?> грн.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                       
                       
                      <?php endforeach; ?>
                      <?php endif; ?>
                 </div>
                  
                  <?php if(!empty($_SESSION['products'])): ?>

                      <?php if(!isset($_SESSION['u_id'])): ?>
                          <div class="col-md-12 text-center">
                              <h3>Для підтвердження замовлення будь ласка <a href="/user/login/">увійдіть</a>, або <a href="/user/login/">зареєструйтеся</a></h3>
                              <br />
                              <a href="/user/login/" class="btn btn-primary">Увійти</a>
                              <a href="/user/register/" class="btn btn-primary">Зареєструватися</a>
                          </div>
                          <?php else: ?>
                          <div class="col-md-6">
                              <a href="/cart/confirm/" class="btn btn-primary">Підтвердити</a>
                              <a href="/cart/delete/" class="btn btn-danger">Очистити корзину</a>
                          </div>
                          <div class="col-md-6">
                              <p>
                                <span class="label label-default pull-right" style="font-size: 16px;">
                                    <?php echo $total; ?> грн.
                                </span>
                              </p>
                          </div>

                      <?php endif; ?>




                       
                  <div class="clearfix"></div>

                   <?php endif; ?>

              </div>
          </div>
          <div class="clearfix"></div>
      </div>
       
           
           

           
</div>

<?php include_once(ROOT . '/views/layout/footer.php'); ?>