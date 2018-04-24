<?php
    require_once '../controller/c_process.php';
    require_once '../model/m_search.php';

    $c_process = new C_process();
    $txtSearch = $c_process->clearForm($_POST['txtSearch']);
    $m_search = new M_search();
    $result = $m_search->searchAjax($txtSearch);
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
