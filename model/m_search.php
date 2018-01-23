<?php
    require_once '../config/database.php';

    class M_search extends Database {
        function searchAjax( $search) {
            $query = "SELECT * FROM article WHERE title LIKE '%$search%'";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }
    }
?>