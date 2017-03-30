<?php include_once(ROOT . '/views/layout/header.php'); ?>
   
<div class="clearfix"></div>

   <div class="container-fluid content">
       
       <div class="row">
          <div class="col-md-12 hidden-xs">
              <ol class="breadcrumb">
                  <li><a href="/"> Головна</a></li>
                  <?php if(isset($catAbbr) && !empty($catAbbr)): ?>
                  <li class="active">
                               <?php echo $title; ?>
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
           </div>
           <div class="col-md-9 col-main">
               <div class="main">
                   <div class="row">
                       <div class="col-md-12">
                           <h3><?php echo $title; ?></h3>
                           <hr />
                                          
                           <div class="goods">
                               <div class="row">
                                   <?php foreach($categories as $cat): ?>
                                         <?php if($cat['cat_name'] == $title): ?>
                                            <?php foreach($categories as $child): ?>
                                                <?php if($child['parent'] == $cat['cat_id']): ?>
                                                    <a href="/category/<?php echo $cat['cat_abbr'] . '/' . $child['cat_abbr'] . '/page-1' ?>/" class="main-page-a">
                                                        <div class="col-md-4 banner">
                                                            <div class="wrapper">
                                                                 <div class="img">
                                                                     <div class="mask"></div>
                                                                     <img src="/template/img/catalog/<?php echo $child['image']; ?>" alt="">
                                                                 </div>
                                                                 <div class="description">
                                                                    <p><?php 
                                                                        $short = array();
                                                                        $short = explode(',', $child['cat_name']);
                                                                        echo $short[0];
                                                                    ?></p>
                                                                 </div>
                                                            </div>

                                                        </div>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>      
                                    <?php endforeach; ?>    
                                                                    
                                 
                               </div>
                           </div>
                           
                       </div>
                   </div>
               </div>
           </div>
           

           
       </div>
   </div>
   
  <?php include_once(ROOT . '/views/layout/footer.php'); 