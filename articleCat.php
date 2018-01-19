<?php
    $catID = $_GET['cat'];
    if( isset($catID) && filter_var($catID, FILTER_VALIDATE_INT, ['option' => 'min_range' > 0 ]) ) {
        require_once './header.php';
        require_once '../controller/c_article.php';
        
        $c_article = new C_article($catID);
        $c_article->configPagination();
        require_once './footer.php';
    } else {
        header('location: index.php');
    }
?>