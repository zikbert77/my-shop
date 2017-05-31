<div class="col-md-3 text-center left-admin-panel" style="padding-left: 0;">
               <div class="stacked">
                   <div class="main">
                   <h1><a href="/"><?= SITE_NAME ?></a> </h1>
                   <hr>
                   <ul class="nav nav-pills nav-stacked">
                      <li role="presentation" <?= ($title=='Загальна інформація')? 'class="active"' : '' ?>><a href="/admin/main/">Загальна інформація</a></li>
                      <li role="presentation" <?= ($title=='Додати товар')? 'class="active"' : '' ?>><a href="/admin/addProduct/">Додати товар</a></li>
                      <li role="presentation" <?= ($title=='Редагування товарів')? 'class="active"' : '' ?>><a href="/admin/products/">Редагування товарів</a></li>
                      <li role="presentation"><a href="#">Статистика продаж</a></li>
                      <li role="presentation"><a href="#">Адміни і продавці</a></li>
                      <li role="presentation"><a href="#">Користувачі</a></li>
                    </ul>
               </div>
               </div>
           </div>