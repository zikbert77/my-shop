<?php include_once(ROOT . '/views/layout/header.php'); ?>

<div class="container-fluid content">

      
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="main" style="border-right: 1px solid #ccc;">
                  <h1>Підтвердження покупок</h1>
                  <hr>
                   <?php if(isset($success)): ?>
                  
                  <p class="bg-success" style="padding: 10px; font-size: 32px;"><?= $success ?></p>
                  
                  <?php else: ?>
                  <p>
                      <span>
                          <?= $totalCount ?> на суму: &nbsp; <b> <?= $totalPrice ?> грн.</b>
                      </span>
                  </p>
                  <hr>
                  <?php 
                  
                    if(isset($errors) && !empty($errors)){
                        foreach ($errors as $error){
                            echo '<p class="bg-warning">'. $error . '</p>';
                        }
                    }
                  
                  ?>
                  
                 
                   <div class="goods">
                       <form action="#" method="post" id="confirmation-form">
                       <input type="hidden" name="total" value="<?= $totalPrice ?>">
                        <div class="row">
                            <div class="col-md-6">
                               <p>
                                   <label for="user-name">Ім'я:</label>
                                   <input type="text" class="form-control" value="<?= isset($user_info) ? $user_info['first_name'] : '' ?>" name="user-name" placeholder="Ім'я" required="required">
                               </p>
                               <p>
                                   <label for="user-surname">Фамілія:</label>
                                   <input type="text" class="form-control" value="<?= isset($user_info) ? $user_info['last_name'] : '' ?>" name="user-surname" placeholder="Фамілія" required="required">
                               </p>
                               <p>
                                   <label for="user-phone">Телефон:</label>
                                   <input type="tel" class="form-control"  value="<?= isset($user_info) ? $user_info['phone'] : '' ?>" name="user-phone" placeholder="050 000 00 00" required="required">
                               </p>
                               <p>
                                    <label for="district">Область:</label>
                                    <select name="district" id="district" class="form-control">
                                        <option disabled selected>Виберіть область</option>
                                        <?php $i = 0; ?>
                                        <?php foreach($areas as $item): ?>
                                        
                                        <option value="<?= $item->Ref ?>"<?=  (isset($_GET['district']) && $_GET['district'] == $item->Ref)? 'selected' : ''; ?>><?= $item->Description ?></option>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                                <p id="city-p">
                                    <label for="city">Місто:</label>
                                    <select name="city" id="city" class="form-control">
                                        <option disabled selected>Виберіть місто</option>                                        
                                    </select>
                                </p>
                                <p id="warehouse-p">
                                    <label for="warehouse">Відділення нової пошти:</label>
                                    <select name="warehouse" id="warehouse" class="form-control" required="required">
                                        <option disabled selected>Виберіть відділення</option>                                        
                                    </select>
                                </p>
                                <p>
                                    <label for="pay">Спосіб оплати:</label>
                                    <select name="pay" id="pay" class="form-control">
                                        <option value="np">Накладний платіж</option>
                                        <option value="pb">Карта Приват Банку</option>
                                    </select>
                                </p>
                            </div>
                            
                            <div class="col-md-6 nova-poshta-img text-center">
                                <p>
                                    Відправка товарів відбувається транспортним перевізником "Нова Пошта"
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <hr>
                        <div class="card-send">
                           <button type="submit" name="confirm-ok" class="btn btn-primary">Підтвердити</button>
                           <button type="submit" name="confirm-cancel" class="btn btn-danger">Відмінити</button>
                       </div>
                         
                     </form>
                      
                   </div>
                   
                   <?php endif; ?> 
                  
              </div>
          </div>
          
          <div class="clearfix"></div>
      </div>
       
           
           

           
</div>
<?php include_once(ROOT . '/views/layout/footer.php'); ?>