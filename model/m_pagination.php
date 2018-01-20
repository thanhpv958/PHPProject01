<?php
    require_once '../config/database.php';
    class M_pagination extends Database {

        public function countRowData($tableName) {
            $query = "SELECT COUNT(id) FROM $tableName";
            $this->setQuery($query);
            return $this->countRow();
        }
        public function pagination($tableName, $start, $limit) {
            $query = "SELECT * FROM $tableName ORDER BY id DESC LIMIT $start, $limit";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }

        public function paginationArticleCat($tableName, $start, $limit, $catID) {
            $query = "SELECT * FROM $tableName WHERE category='$catID' ORDER BY id DESC LIMIT $start, $limit";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }
        
    }
?>