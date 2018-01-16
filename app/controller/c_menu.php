<?php
    require_once '../model/m_admin.php';
    class c_menu {

        function showCategories($categories=NULL,$parent_id=0, $char='-') {
            $M_admin = new M_admin();
            $categories  = $M_admin->getCategories($parent_id);
            foreach ($categories as $key => $item) { 
                if ($item['parent_id'] == $parent_id)
                {
                   echo "<option value='".$item['id']."'>".$char.$item['title']."</option>";
                    $this->showCategories($categories, $item['id'], $char.'|---');
                }
            }
            
        }

        function selectCtrl($name, $class) {
            echo "<select name='".$name."' class='".$class."'>";
            echo "<option value='0'>Danh mục cha</option>";
            $this->showCategories();
            echo "</select>";
        }
    }
    
?>


