<?php
    require_once '../config/database.php';

    class M_article extends Database {
        
        function showNameCategory($id) {
            $query = "SELECT * FROM menu WHERE id='$id'";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }

        function addArticle($title, $body, $category, $image, $time, $status) {
            $query = "INSERT INTO article (title, body, category, image, time, status) VALUES ('$title', '$body', '$category', '$image', '$time', $status)";
            return $this->setQuery($query);
        }
    }
?>