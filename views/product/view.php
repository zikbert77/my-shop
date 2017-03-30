<?php include_once(ROOT . '/views/layout/header.php'); ?>

   <div class="clearfix"></div>

   <div class="container-fluid content">
      <div class="row">
          <div class="col-md-12 hidden-xs">
              <ol class="breadcrumb">
                  <li><a href="/"> Головна</a></li>
                  <?php if(isset($product_info['category']['parent_name']) && !empty($product_info['category']['parent_name'])): ?>
                  <li>
                          <a href="/catalog/<?php echo $product_info['category']['parent_abbr'].'/'; ?>">
                               <?php echo $product_info['category']['parent_name']; ?>
                          </a>
                   </li>
                   <?php endif; ?>
                   <?php if(isset($product_info['category']['cat_name']) && !empty($product_info['category']['cat_name'])): ?>
                   <li>
                          <a href="/category/<?php echo $product_info['category']['parent_abbr']; ?>/<?php echo $product_info['category']['cat_abbr'] .'/page-1/'; ?>">
                              <?php echo $product_info['category']['cat_name']; ?>
                          </a>
                    </li>
                    <?php endif; ?>
                   <li class="active"><?php echo $product_info['product_name']; ?></li>
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
           </div>
           <div class="col-md-9 col-main">
               <div class="main">
                   <div class="row">
                       <div class="col-md-12">
                           <h3><?php echo $product_info['product_name']; ?></h3>
                           <hr />
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-5">

                                   <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
                                       
                                   <?php for($i=0; $i < count($images); $i++){
                                       
                                      echo '<img src="' . $images[$i] . '" alt="'.$title.'">';
                                       
                                   }
                                   
                                   ?>
           
                                    </div>
                               </div>
                               <div class="col-md-7">
                                   <div class="product-properties">
                                       <table class="table table-bordered">
                                          <tr>
                                               <td>Тип:</td>
                                               <td><?php echo $product_info['category']['cat_name']; ?></td>
                                          </tr>
                                          <tr>
                                               <td>Виробник:</td>
                                               <td><?php echo $product_info['brand_name']; ?></td>
                                           </tr>
                                           <tr>
                                               <td>Країна:</td>
                                               <td><?php echo $product_info['country']; ?></td>
                                           </tr>
                                       </table>
                                   </div>
                                   <br><br>
                                   <div class="row">
                                       <div class="col-md-5">
                                           <form class="product-form" method="post" action="/cart/add/">
                                               <input type="hidden" name="parent_abbr" value="<?php echo $product_info['category']['parent_abbr']; ?>">
                                               <input type="hidden" name="cat_abbr" value="<?php echo $product_info['category']['cat_abbr']; ?>">
                                               <input type="hidden" name="product_id" value="<?php echo $product_info['product_id']; ?>">
                                               <input type="hidden" name="product_name" value="<?php echo $product_info['product_name']; ?>">
                                               <input type="hidden" name="product_price" value="<?php echo $product_info['price'] ?>">
                                               <label for="product_size">Виберіть розмір: </label>
                                               <select name="product_size" id="p_size" class="form-control">
                                                   <?php
                                                        if($sizes->XS != 0){
                                                            echo '<option value="XS">XS</option>';
                                                        }
                                                        if($sizes->S != 0){
                                                            echo '<option value="S">S</option>';
                                                        }
                                                        if($sizes->M != 0){
                                                            echo '<option value="M">M</option>';
                                                        }
                                                        if($sizes->L != 0){
                                                            echo '<option value="L">L</option>';
                                                        }
                                                        if($sizes->XL != 0){
                                                            echo '<option value="XL">XL</option>';
                                                        }
                                                        if($sizes->XXL != 0){
                                                            echo '<option value="XXL">XXL</option>';
                                                        }
                                                   
                                                   ?>
                                               </select>
                                               <br>
                                               <?php if(Cart::checkProduct($product_info['product_id'])): ?>
                                                    <button type="submit" name="addProduct" class="btn btn-success btn-block"><i class="fa fa-check" aria-hidden="true"></i> Куплено</button>
                                                    
                                               <?php else: ?>
                                                    <button type="submit" name="addProduct" class="btn btn-primary btn-block"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Купити</button>
                                               <?php endif; ?>
                                               
                                           </form>
                                       </div>
                                       <div class="col-md-5 price">
                                           <span class="price">
                                               <?= $product_info['price'] ?> грн.
                                           </span>
                                       </div>
                                       <div class="clearfix"></div>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-12">
                                  <hr>
                                   <div class="about-product">
                                      <h3>Опис</h3>
                                       <hr>
                                       <p>
                                           <?php echo htmlspecialchars_decode($product_info['description']); ?>
                                       </p>
                                   </div>
                                   <div class="comments">
                                       <hr>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           


           
       </div>
   </div>
   
  
 <?php include_once(ROOT . '/views/layout/footer.php'); ?>