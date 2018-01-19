<?php
    require_once '../config/database.php';
    class M_menu extends Database {

        function addMenu($title, $parent_id, $link, $status) {
            $query = "INSERT INTO menu (title, parent_id, link, status) VALUES ('$title', $parent_id, '$link', $status)";
            return $this->setQuery($query);
        }

        function getMenu($parent_id) {
            $query = "SELECT * FROM menu WHERE parent_id='$parent_id' ORDER BY id ASC";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }
    }
?>
