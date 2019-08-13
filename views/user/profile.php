<?php include_once(ROOT . '/views/layout/header.php'); ?>

<div class="container-fluid content">

      
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="main" style="border-right: 1px solid #ccc;">
                  <div class="row">
                      <div class="col-md-12">
                          <h1><?php echo $user_info['first_name'] . ' ' . $user_info['last_name']; ?></h1>
                          <hr />
                          <div class="row">
                              <div class="col-md-3">
                                  <ul class="nav nav-pills nav-stacked" role="tablist">
                                    <li role="presentation" class="active"><a href="#panel_profile" aria-controls="panel_profile" role="tab" data-toggle="tab">Особисті дані</a></li>
                                    <li role="presentation"><a href="#panel_orders" aria-controls="panel_orders" role="tab" data-toggle="tab">Мої замовлення</a></li>
                                  </ul>
                              </div>
                              <div class="col-md-9 tab-content">
                                  
                                  <div role="tabpanel" class="tab-pane fade in active" id="panel_profile" >
                                      <h3>Особисті дані</h3>
                                      <br>
                                      <div class="row">
                                          <div class="col-md-4">
                                              <ul style="list-style: none; font-size: 16px;">
                                                  <li>Ім'я</li>
                                                  <li>Email</li>
                                                  <li>Телефон</li>
                                              </ul>
                                          </div>
                                          <div class="col-md-4">
                                              <ul style="list-style: none; font-size: 16px;">
                                                  <li><?php echo (!empty($user_info['u_name']))? $user_info['u_name'] : '';
                                                  echo (!empty($user_info['u_name']))? ' '.$user_info['u_surname'] : ''; ?></li>
                                                  <li><?php echo (!empty($user_info['u_email']))? $user_info['u_email'] : ''; ?></li>
                                                  <li><?php echo (!empty($user_info['u_phone']))? $user_info['u_phone'] : ''; ?></li>
                                              </ul>
                                          </div>
                                          <div class="col-md-4">
                                              <a href="#">Редагувати особисті дані</a><br>
                                              <a href="#">Змінити пароль</a>
                                          </div>
                                      </div>
                                      <hr>
                                      <h3>Ваша знижка</h3>
                                      <span class="alert-link discount" data-toggle="popover" data-content="Постійним клієнтам - знижки!" data-trigger="hover" data-placement="top">
                                          0%</span>
                                  </div>  
                                  
                                  <div role="tabpanel" class="tab-pane fade" id="panel_orders">
                                      <h3>Мої замовлення</h3>
                                      <br>
                                      <div class="row">
                                          <?php if(isset($user_orders) && !empty($user_orders)): ?>
                                          
                                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                          <?php $i=0; ?> 
                                          <?php foreach($user_orders as $order): ?>
                                              
                                              <?php if($order['order_status']==0){
                                                    $o_style = 'default';
                                                    $o_status = 'Виконується';
                                                    $o_img = '/template/img/shipment/in_process.png';
                                                  } elseif($order['order_status']==1){
                                                    $o_style = 'success';
                                                    $o_status = 'Виконано';
                                                    $o_img = '/template/img/shipment/complete.png';
                                                  } elseif($order['order_status']==(-1)){
                                                    $o_style = 'danger';
                                                    $o_status = 'Не виконано';
                                                    $o_img = '/template/img/shipment/failed.png';
                                                  } else {
                                                    $o_style = '';
                                                    $o_status = '';
                                                    $o_img = '';
                                                  }
                                                  
                                              ?>
                                              <div class="panel panel-<?= $o_style ?>">
                                                  <div class="panel-heading" role="tab" id="heading<?= $i ?>">
                                                    <h4 class="panel-title">
                                                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                                                          <div class="row">
                                                              <div class="col-md-4"><i class="fa fa-angle-down" aria-hidden="true"></i> №<?= $order['order_id'] ?></div>
                                                              <div class="col-md-4 text-center"><?= $order['order_date'] ?></div>
                                                              <div class="col-md-4 text-right"><?= $o_status ?></div>
                                                          </div>
                                                      </a>
                                                    </h4>
                                                  </div>
                                                  <div id="collapse<?= $i ?>" class="panel-collapse collapse <?= ($i == 0)? 'in' : '' ?>" role="tabpanel" aria-labelledby="heading<?= $i ?>">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-8" style="border-right: 1px solid #ccc;">
                                                                <br>
                                                                
                                                                <?php foreach($order['order_info']->products as $id => $product): ?>
                                                                
                                                                <?php $all_product_info = Product::getProductInfo($id);  ?>
                                                                
                                                                
                                                                <div class="media">
                                                                    <div class="media-left">
                                                                        <a href="/product/<?= $id ?>">
                                                                            <img class="media-object" src="/products/<?= $product->parent_abbr ?>/<?= $product->cat_abbr ?>/<?= $id ?>/img/IMG_<?= $id ?>_1.jpg" alt="...">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-9 col-xs-7">
                                                                                <h4 class="media-heading"><?= $all_product_info['product_name'] ?></h4>
                                                                                <span>
                                                                                    Кількість: <?= $product->count ?>
                                                                                    Розмір: <?= $product->size ?>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-3 col-xs-5 text-center to-trash">
                                                                                <p>
                                                                                    <br>
                                                                                    <span><?= $product->count * $product->price ?> грн.</span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                
                                                                
                                                                <?php endforeach; ?>
                                                                <p class="pull-right">Загальна вартість: <b><?= $user_orders[$i]['order_info']->total; ?> грн.</b></p>
                                                                
                                                                
                                                                
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4>Статус:</h4>
                                                                <div class="shipment-img text-center">
                                                                    <img src="<?= $o_img ?>">
                                                                    <hr>
                                                                </div>
                                                                <span>№ ТТН: <?= ($order['order_ttn'] == 0)? 'Очікується' : $order['order_ttn'] ?></span>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                          <?php $i++; ?>
                                          <?php endforeach; ?>
                                                
                                                                                                
                                              </div>
                                          <?php else: ?>
                                          
                                          <center><h3>У вас ще немає замовлень</h3></center>
                                          
                                          <?php endif; ?>
                                                
                                      </div>
                                  </div> 
                              </div>
                              
                          </div>
                          
                            
                          
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
          <div class="clearfix"></div>
      </div>
      
</div>

<?php include_once(ROOT . '/views/layout/footer.php'); ?>