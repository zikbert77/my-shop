<?php include_once(ROOT . '/views/layout/header.php'); ?>

<div class="container-fluid content">

      
      <div class="row">
          <div class="col-md-10 col-md-offset-1 text-center">
              <div class="main" style="border-right: 1px solid #ccc;">
                  <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                          <h3>Реєстрація</h3>
                          <?php 
                          
                          if(isset($errors) && is_array($errors)){
                              foreach($errors as $error){
                                  echo "<p class='bg-danger' style='padding: 5px;'>$error</p>";
                              }
                          }
                          
                          ?>
                          <?php if(!isset($success)): ?>
                          <form action="#" method="post">
                              <p><input type="text" class="form-control" name="r_name" placeholder="Ім'я" value="<?php echo (isset($name))? $name : ''; ?>"></p>
                              <p><input type="email" class="form-control" name="r_email" placeholder="Email" value="<?php echo (isset($email))? $email : ''; ?>"></p>
                              <p><input type="password" class="form-control" name="r_pass1" placeholder="Пароль" value="<?php echo (isset($pass1))? $pass1 : ''; ?>"></p>
                              <p><input type="password" class="form-control" name="r_pass2" placeholder="Пароль ще раз" value="<?php echo (isset($pass2))? $pass2 : ''; ?>"></p>
                              <p><input type="submit" class="btn btn-primary btn-block" name="r_submit" value="Зареєструватися"></p>
                              <a href="/user/login/">Увійти </a>
                          </form>
                          <?php else: ?>
                          <?php echo $success; ?>
                          <?php endif; ?>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
          <div class="clearfix"></div>
      </div>
      
</div>

<?php include_once(ROOT . '/views/layout/footer.php'); ?>