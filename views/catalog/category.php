<?php include_once(ROOT . '/views/layout/header.php'); ?> 
<div class="clearfix"></div>


   <div class="container-fluid content">
       
       <div class="row">
          <div class="col-md-12 hidden-xs">
              <ol class="breadcrumb">
                  <li><a href="/"> Головна</a></li>
                  <?php if(isset($catAbbr) && !empty($catAbbr)): ?>
                  <li>
                          <a href="/catalog/<?php echo $catAbbr; ?>/">
                               <?php echo $title; ?>
                          </a>
                   </li>
                   <?php endif; ?>
                   <?php if(isset($childAbbr) && !empty($childAbbr)): ?>
                   <li class="active">

                              <?php echo $child_title; ?>
                         
                    </li>
                    <?php endif; ?>
                </ol>
          </div>
      </div>

       <div class="row">
           <div class="col-md-3 col-left-menu">
               <div class="left-menu">
                   <center><h1>Каталог</h1></center>
                   <hr>
                   <ul class="nav nav-pills nav-stacked">

                       <!--Left menu include-->
                       <?php include_once ROOT . '/views/layout/left_menu.php'; ?>

                   </ul>
               </div>
               <br>
               <div class="left-menu">
                   <center><h1>Параметри</h1></center>
                   <hr>
                   <form>

                       <h4>Ціна:</h4>
                       <div class="form-group">
                           <div class="row">
                               <div class="col-xs-3 col-xs-offset-2"><input type="text" name="price-from" class="form-control" id="price_from" value="<?= isset($this->sorted_array['price_from'][0])? $this-> sorted_array['price_from'][0] : $min ?>" placeholder="From"></div>

                               <div class="col-xs-3"><input type="text" name="price-to" class="form-control" id="price_to" value="<?= isset($this->sorted_array['price_to'][0])? $this-> sorted_array['price_to'][0] : $max ?>" placeholder="To" onchange="priceFunction()"></div>
                               <div class="clearfix"></div>
                           </div>
                       </div>
                       <hr>
                       <h4>Виробник:</h4><br>
                       <?php foreach ($brands as $brand): ?>

                           <div class="form-group">
                               <div class="row">
                                   <div class="col-md-2"><label for="brand"><?= Product::getBrand($brand) ?> </label></div>
                                   <div class="col-md-10"><input type="checkbox" name="brand[]" <?= (isset($this->sorted_array['brand_id']) && in_array($brand, $this->sorted_array['brand_id']))? 'checked' : '' ?> value="<?= $brand ?>" onclick="location.href='<?= $page_link . Category::createSortLink($this->sorted_array, 'brand_id', $brand) ?>'">
                                   </div>
                               </div>

                           </div>

                       <?php endforeach; ?>
                       <hr>
                   </form>
               </div>

           </div>

           <div class="col-md-9 col-main">
               <div class="main">
                   <div class="row">
                       <div class="col-md-12">
                           <h3><?php echo $title; ?> <?php echo '/&nbsp;' . $child_title . '<small> &nbsp;  '. $countProducts .'</small>'; ?> </h3>
                           <hr />
                           <span>Сортувати: </span>
                           <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'low_price') ?>">Найнижча ціна</a> |
                           <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'high_price') ?>">Найвища ціна</a> |
                           <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'new') ?>">Найновіші</a> |
                           <a href="<?= $page_link . Category::createSortLink($this->sorted_array, 'sort', 'old') ?>">Старі</a>
                           <div class="goods">
                               <div class="row">

                                   <?php if(!empty($product_in_category)): ?>

                                        <?php foreach($product_in_category as $product): ?>

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
                                                        <img src="/products/<?php echo $product_preview . $product['product_id'] . '/img/IMG_' .$product['product_id'] . '_0.jpg' ; ?>" alt="Фото <?php echo $product['product_name']; ?>">
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
                                   
                                   <?php endif; ?>
                                 
                               </div>
                           </div>
                           <div class="paginations">
                               <div class="row">
                                   <div class="col-lg-12 text-center">
                                      <hr>
                                       <nav aria-label="Page navigation">
                                          <?= $pagination->get() ?>
                                        </nav>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           

           <p id="test"></p>
       </div>

    <script>
        $(document).ready(function (){

            $("#price_from").bind("change", function(){
                var params = {
                    price_from: $("#price_from").val()
                }


                $.get("<?php $_SERVER['REQUEST_URI'] ?>", params, function(data){

                    location.href ="<?= $page_link ?>" + data;

                });
            });

            $("#price_to").bind("change", function(){
                var params = {
                    price_to: $("#price_to").val()
                }


                $.get("<?php $_SERVER['REQUEST_URI'] ?>", params, function(data){

                    location.href ="<?= $page_link ?>" + data;

                });
            });

        });
    </script>
  <?php include_once(ROOT . '/views/layout/footer.php'); ?>