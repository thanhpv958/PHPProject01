<?php
    require_once './c_pagination.php';
    $ab = new C_pagination();

    
    

    $config = array(
        'current_page'  => 2, 
        'limit'         => 1, 
        'link_full'     => 'listVideo.php?page={page}',
        'link_first'    => 'listVideo.php',
        'tableName'     => 'video'

    );

    $ab->init($config);
    echo '<pre>';
    print_r($ab->html());
    echo '</pre>';
  
    
?>