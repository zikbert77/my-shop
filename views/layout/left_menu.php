<?php 
                       foreach($categories as $category){
                           
                           
                           if($category['parent'] == 0){
                               if(!isset($category['child'])){
                                   
                                       
                                   
                                       echo '<li role="presentation" class="';
                                   
                                       if($title == $category['cat_name']){
                                           echo ' active';
                                       }
                                   
                                        echo '"><a href="/catalog/'. $category['cat_abbr'] .'">'. $category['cat_name'] .'</a></li>';
                                   
                                   
                               } else {
                                   
                                   
                                   
                                   echo '<li role="presentation" class="dropdown ';
                                   
                                   if($title == $category['cat_name']){
                                       echo ' active';
                                   }
                                   
                                   echo '">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                              '. $category['cat_name'] .' <span class="caret"></span>
                                          </a>
                                          <ul class="dropdown-menu" style="left: 100px;">
                                   ';
                                   
                                   foreach($categories as $child){
                                       if($child['parent'] == $category['cat_id']){
                                            echo '<li class="'; 
                                            
                                            if($child_title == $child['cat_name']){
                                               echo ' active';
                                           }

                                            echo                                           
                                                
                                                '"><a href="/category/'.$category['cat_abbr'].'/'. $child['cat_abbr'] .'/">'. $child['cat_name'] .'</a></li>';
                                       }
                                   }
                                   
                                   echo '
                                          </ul>
                                      </li>
                                   ';
                                   
                               }
                           

                               
                           }
                       }
                       
 ?>