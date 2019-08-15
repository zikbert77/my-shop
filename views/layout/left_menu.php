<?php
foreach ($categories as $category) {
    if ($category['parent'] == 0) {
        if (!isset($category['child'])) {
            echo '<li role="presentation" class="';

            if ($title == $category['title']) {
               echo ' active';
            }
            echo '"><a href="/catalog/'. $category['abbr'] .'">'. $category['title'] .'</a></li>';
        } else {
            echo '<li role="presentation" class="dropdown ';
            if ($title == $category['title']) {
               echo ' active';
            }
            echo '">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      '. $category['title'] .' <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" style="left: 100px;">
            ';
            foreach ($categories as $child) {
               if ($child['parent'] == $category['id']) {
                    echo '<li class="';

                    if ($child_title == $child['title']) {
                        echo ' active';
                    }
                    echo '"><a href="/category/'.$category['abbr'].'/'. $child['abbr'] .'/">'. $child['title'] .'</a></li>';
               }
            }

            echo '
                  </ul>
              </li>
            ';

        }
    }
}