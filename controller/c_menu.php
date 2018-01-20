<?php
    require_once '../model/m_menu.php';
    class c_menu {

        //  function recurSelectMenu($categories=NULL, $parent_id=0, $char=0) {
        //     $M_admin = new M_admin();
        //     $categories  = $M_admin->getCategories($parent_id);
        //     foreach ($categories as $key => $item) { 
        //         if ($item['parent_id'] == $parent_id)
        //         {
        //            echo "<option value='".$item['id']."'>".$char.$item['title']."</option>";  
        //         }
        //         $this->recurSelectMenu($categories, $item['id'], ++$char);
        //     } 
        // }
        function recurSelectMenu($parent_id=0, $char='') {
            $m_menu = new M_menu();
            $menu  = $m_menu->getMenu($parent_id);
            if($menu) {               
                    foreach($menu as $key => $value) {
                        echo "<option value='".$value['id']."'>".$char.$value['title']."</option>"; 
                        $this->recurSelectMenu($value['id'], '-');                   
                    }        
            }
        }

        function recurSelectMenuArticle($nameCat) {
            $m_menu = new M_menu();
            $menuArticle  = $m_menu->getMenuArticle($nameCat);
            echo "<option value='".$menuArticle[0]['id']."'>".$menuArticle[0]['title']."</option>"; 

            $menuRemain = $m_menu->getMenuArticleRemain($nameCat);
            foreach($menuRemain as $value) {
                echo "<option value='".$value['id']."'>".$char.$value['title']."</option>"; 
            }
            
        }
        function recurULMenu( $parent_id=0, $count=0) {
            $m_menu = new M_menu();
            $menu  = $m_menu->getMenu($parent_id);

            if($menu) {
                // if($count == 0) {
                //     echo "<ul class='navbar-nav ml-auto'>";
                //     echo "<li class='nav-item'><a class='nav-link' href='index.php'>Home</a></li>";
                //     echo "</ul>";
                // }
                echo '<ul class="navbar-nav ml-auto">';
                    foreach($menu as $key => $value) {

                        if($count == 0) {
                            echo "<li class='nav-item'><a class='nav-link' href='index.php'>Home</a></li>";
                        }
                        
                        echo "<li class='nav-item'><a class='nav-link' href='../views/articleCat.php?cat=".$value['id']."'>".$value['title']."</a>";
                        $this->recurULMenu($value['id'], ++$count);
                        echo "</li>";
                    }
                echo '</ul>';
            }
        }


        function addMenu($title, $parent_id, $link, $status) {
            $errors = [];
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if( empty($title) ) {
                    echo $errors['title'] = '<p class="errorAddVideo">You should enter title</p>';     
                }

                if( empty($link) ) {
                    echo $errors['link'] = '<p class="errorAddVideo">You should enter link</p>';
                } 
                    
                if(empty($errors)) {
                    $m_menu = new M_menu();
                    return $m_menu->addMenu($title, $parent_id, $link, $status);  
                }
            } else {
                die('FAIL');
            }
        }
    }
    
?>


