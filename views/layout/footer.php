<footer>
       <div class="container">
           <div class="row">
               <div class="col-md-4">
                  <span>Допомога</span>
                   <ul>
                       <li><a href="#">Про нас</a></li>
                       <li><a href="#">Як оформити замовлення?</a></li>
                       <li><a href="#">Повернення товару</a></li>
                       <li><a href="#">Зворотній зв'язок</a></li>
                       <li><a href="#">Правила користування сайтом</a></li>
                   </ul>
               </div>
               <div class="col-md-4">
                   <span>Способи оплати</span><br>
                   <span class="card">
                       <img src="/template/img/master%20card.png" alt="Master Card">
                       <img src="/template/img/visa.png" alt="Visa Card">
                       <img src="/template/img/privat24.png" alt="Privat 24">
                   </span>
                   <br>
                   <span class="description">
                       Ви можете оплатити покупки онлайн, або при отриманні в відділенні нової пошти.
                   </span>
               </div>
               <div class="col-md-4">
                   <span>Ми в соціальних мережах</span><br>
                   <a href="#" class="brand"><i class="fa fa-vk" aria-hidden="true"></i></a>
                   <a href="#" class="brand"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
               </div>
           </div>
       </div>
   </footer>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/template/js/bootstrap.js"></script>
    
    <script src="/template/js/slick/slick-1.6.0/slick/slick.js"></script>
    <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        arrows: true,
        dots: true,
        autoplay: true,
        infinite: true,
        autoplaySpeed: 3700,
        swipeToSlide: true,
        slidesToShow: 4,
        slidesToScroll: 1
      });
    });
  </script>
  
  <script>
      $(function(){
          $('[data-toggle="tooltip"]').tooltip();
          $('[data-toggle="popover"]').popover();
      });
   </script>
  <?php if(isset($page) && $page == 'confirm'): ?>
   
   <script>
       $(document).ready(function (){
          $("#city-p").hide();
          $("#district").bind("change", function(){
              var params = {
                  area: $("#district").val()
              }
              
              
              $.get("/cart/ajaxCity/", params, function(data){
                  $("#city-p").show();
                  $("select[name='city']").empty();
                  data = JSON.parse(data);
                  $("select[name='city']").append($("<option selected disabled>Виберіть місто</option>"));
                  for(var i = 0; i < data.length; i++){
                       $("select[name='city']").append($("<option value='"+ data[i]["CityRef"] +"'>"+ data[i]["Description"] +"</option>"));
                   }
              });
          });
         
       });
   </script>
   <script>
   $(document).ready(function() {
          $("#warehouse-p").hide();
          $("#city").bind("change", function(){
              var params = {
                  city: $("#city").val()
              }
              $.get("/cart/ajaxWarehouse/", params, function(data){
                  $("#warehouse-p").show();
                  $("select[name='warehouse']").empty();
                  data = JSON.parse(data);
                  $("select[name='warehouse']").append($("<option selected disabled>Виберіть відділення</option>"));
                  for(var i = 0; i < data.length; i++){
                       $("select[name='warehouse']").append($("<option value='"+ data[i]["Ref"] +"'>"+ data[i]["Description"] +"</option>"));
                   }
              });
          });
   });
   </script>
  <?php endif; ?>
  
  </body>
</html>