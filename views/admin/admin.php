<?php include_once(ROOT . '/views/layout/admin_header.php'); ?>

   <div class="clearfix"></div>
   <div class="container-fluid content">
       <div class="row">

       <?php include_once ROOT . '/views/layout/admin_left_menu.php' ?>

           <div class="col-md-9">
            <div class="clearfix"></div>
                   <div class="row">
                       <div class="col-md-12">
                           <h3>Загальна інформація</h3>
                       </div>
                   </div>
                   <hr>
                   <div class="row">
                       <div class="col-md-3 col-xs-12 small">
                           <div class="small-block">
                               <div class="header" style="background: #fd9d18;">
                                   <i class="fa fa-battery-half" aria-hidden="true"></i>
                               </div>
                               <div class="small-info text-right">
                                   <span class="description">Використано місця</span><br>
                                   <span class="value"><?= $free_space ?> / <?= $total_space ?></span>
                               </div>
                               <hr>
                               <span class="addition">Need more space !</span>
                           </div>
                       </div>
                       <div class="col-md-3 col-xs-12 small">
                           <div class="small-block">
                               <div class="header" style="background: #59b15d;">
                                   <i class="fa fa-money" aria-hidden="true"></i>
                               </div>
                               <div class="small-info text-right">
                                   <span class="description">Виручка</span><br>
                                   <span class="value">1748 $</span>
                               </div>
                               <hr>
                               <span class="addition"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> За останні 24 години</span>
                           </div>
                       </div>
                       <div class="col-md-3 col-xs-12 small">
                           <div class="small-block">
                               <div class="header" style="background: #e73e3a;">
                                   <i class="fa fa-info-circle" aria-hidden="true"></i>
                               </div>
                               <div class="small-info text-right">
                                   <span class="description">Проблеми</span><br>
                                   <span class="value">0</span>
                               </div>
                               <hr>
                               <span class="addition"><i class="fa fa-thumb-tack" aria-hidden="true">&nbsp;</i> Повідомлення про проблему</span>
                           </div>
                       </div>
                       <div class="col-md-3 col-xs-12 small">
                           <div class="small-block">
                               <div class="header" style="background: #08b1c6;">
                                   <i class="fa fa-user-plus" aria-hidden="true"></i>
                               </div>
                               <div class="small-info text-right">
                                   <span class="description">Нові користувачі</span><br>
                                   <span class="value"><?= isset($userByThisDay)? $userByThisDay : '0' ?></span>
                               </div>
                               <hr>
                               <span class="addition"><i class="fa fa-users" aria-hidden="true">&nbsp;</i> Нові користувачі</span>
                           </div>
                       </div>
                   </div>
                   <div class="clearfix"></div>
                   <div class="row">
                       <div class="col-lg-4">
                           <div class="small-block">
                               <div class="diagram" style="background: #59b15d;">
                                   <img src="/views/admin/graphic_sold.php" alt="Продано за день" width="100%">
                               </div>
                               <span class="value">Продано за день</span><br>
                               <span class="description"><span class="green">&#8593; 55% </span> Зріст продаж</span>
                               
                           </div>
                           
                       </div>
                       <div class="col-lg-4">
                           <div class="small-block">
                               <div class="diagram" style="background: #fd9d18;">%new_users%</div>
                               <span class="value">Нових користувачів</span><br>
                               <span class="description">По місяцях</span>
                               
                           </div>
                       </div>
                       <div class="col-lg-4">
                           <div class="small-block">
                               <div class="diagram" style="background: #e73e3a;">%add_good%</div>
                               <span class="value">Додано товарів</span><br>
                               <span class="description">По днях</span>
                               
                           </div>
                       </div>
                   </div>

           </div>
       </div>
   </div>

<?php include_once(ROOT . '/views/layout/admin_footer.php'); ?>