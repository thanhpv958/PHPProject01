<?php
    require_once '../model/m_admin.php';
    require_once '../model/m_menu.php';

    class c_menu {

        private function showCategories($categories=NULL,$parent_id=0, $char='-') {
            $M_admin = new M_admin();
            $categories  = $M_admin->getCategories($parent_id);
            foreach ($categories as $key => $item) { 
                if ($item['parent_id'] == $parent_id)
                {
                   echo "<option value='".$item['id']."'>".$char.$item['title']."</option>";
                    $this->showCategories($categories, $item['id'], $char.'--');
                }
            } 
        }

        function selectCtrl($name, $class) {
            echo "<select name='".$name."' class='".$class."'>";
            echo "<option value='0'>Danh mục cha</option>";
            $this->showCategories();
            echo "</select>";
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


