<?php
    require_once '../model/m_search.php';
    $m_search = new M_search();
    $result = $m_search->searchAjax($_POST['txtSearch']);
    $output='';
    if($result) {
        $output .="<ul>";
        foreach ($result as $value) {
            $output .= "<li><a href='article.php?id=".$value['id']."'>".$value['title']."</a></li>";
        }
        $output.="</ul>";   
    }
    echo $output;
?>
