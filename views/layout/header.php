<?php
   if(empty($title)){
       $title = SITE_NAME;
   }

    if(empty($child_title)){
       $child_title= '';
   }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo  $title . ' - Інтернет магазин' ; ?></title>
    <?= isset($meta_name)? '<meta name="keywords" content="'. $meta_name .'">' : '' ?>
    <?= isset($meta_name)? '<meta name="description" content="'.$meta_name.' - купити на Brand City ☑ Найкраща ціна $">' : '' ?>
    <link href="/template/css/style.css" rel="stylesheet">
      <link rel="shortcut icon" href="/template/img/favicon.ico" type="image/x-icon">
    <link href="/template/css/font-awesome.css" rel="stylesheet">


    
    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
        
    <!-- 1. Link to jQuery (1.8 or later), -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->

    <!-- fotorama.css & fotorama.js. -->
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->

    <!-- Bootstrap -->
    <link href="/template/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php if (isset($_SESSION['admin_id'])): ?>
      <?php include_once ROOT . '/views/layout/admin_toolbar.php'; ?>
  <?php endif; ?>
   
   <header>


       
       <div class="top-menu">
            <div class="container-fluid small-top-menu">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Увага!</strong> Цей сайт розміщено на безкоштовному хостингу, тому тут не працюють деякі функції.
                        </div>


                        <a href="#">Запитання та відповіді &nbsp;</a>
                        <a href="#"> Доставка та оплата &nbsp;</a>
                        <a href="#"> Контакти &nbsp;</a>
                        <a href="#"> Відслідкувати замовлення &nbsp;</a>
                    </div>
                </div>
            </div>
           <nav class="navbar navbar-default">
               <div class="container-fluid top-menu-container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                       </button>
                       <a href="/" class="navbar-brand"><?= SITE_NAME ?></a>
                   </div>
                   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                       <form method="post" action="/search/" class="navbar-form navbar-left hidden-xs" id="top-menu-search-form">
                        <div class="form-group">
                          <div class="input-group">
                              <input type="text" name="q" class="form-control" placeholder="Пошук" required>
                              <div class="input-group-addon">
                                  <button id="top-menu-search-button" name="search" type="submit">
                                      <i class="fa fa-search" aria-hidden="true"></i>
                                  </button>
                              </div>
                          </div>
                        </div>
                      </form>
                      <form method="post" action="/search/" class="navbar-form navbar-left visible-xs-block" id="top-menu-search-form-mobile">
                        <div class="form-group">
                          <div class="input-group">
                              <input type="text" name="q" class="form-control" placeholder="Пошук" required>
                              <div class="input-group-addon">
                                  <button id="top-menu-search-button" name="search" type="submit">
                                      <i class="fa fa-search" aria-hidden="true"></i>
                                  </button>
                              </div>
                          </div>
                        </div>
                      </form>
                      <ul class="nav navbar-nav navbar-right">
                            <li role="separator">&nbsp;</li>
                            <li class="card">
                                <a href="/cart/">
                                   
                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> 
                                      Корзина  <?php echo(!empty($_SESSION['products']) ? '<span class="badge">'. count($_SESSION['products']) .'</span>' : ''); ?>
                                </a>
                            </li>
                            
                            <li class="top-menu-user-logo">
                                <?php if(isset($_SESSION['u_name'])): ?>
                                <li><a href="/user/profile/">
                                    <?php echo($_SESSION['u_name']); ?>
                                </a></li>
                                <li><a href="/user/logout/">
                                    Вийти
                                </a></li>
                                <?php else: ?>
                                <li><a href="/user/login/">
                                    Увійти
                                </a></li>
                                <?php endif; ?>
                            </li>
                       </ul>
                   </div>
               </div>
           </nav>
           
       </div>
   </header>