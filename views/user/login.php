<?php include_once(ROOT . '/views/layout/header.php'); ?>

<div class="container-fluid content">

    
      
      <div class="row">
          <div class="col-md-10 col-md-offset-1 text-center">
              <div class="main" style="border-right: 1px solid #ccc;">
                  <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                          
                         
                          
                          <h3>Вхід на сайт</h3>
                          
                           <?php 
                          
                          if(isset($errors)){
                              foreach($errors as $error){
                                  echo "<p class='bg-danger' style='padding: 5px;'>$error</p>";
                              }
                          }
                          
                          ?>
                          <form action="#" method="post">
                              <p><input type="text" class="form-control" name="l_email" placeholder="email"></p>
                              <p><input type="password" class="form-control" name="l_pass" placeholder="Пароль"></p>
                              <p><input type="submit" class="btn btn-primary btn-block" name="l_submit" value="Увійти"></p>
                              <a href="/user/register/">Зареєструватися </a>
                          </form>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
          <div class="clearfix"></div>
      </div>
      
</div>

<?php include_once(ROOT . '/views/layout/footer.php'); ?>