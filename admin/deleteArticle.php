<?php
    require_once '../controller/c_article.php';
    $c_article = new C_article();
    $id = isset($_GET['id']) ? $_GET['id'] : header('location: ./listArticle.php');
    return $c_article->deleteArticleByID($id);
?>