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

        function editArticle($id, $title, $body, $category, $image, $status) {
            $query = "UPDATE article SET title='$title', body='$body',  category='$category', image='$image', status=$status WHERE id=$id";
            return $this->setQuery($query);
        }
    }
?>