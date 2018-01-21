<?php
    require_once '../config/database.php';
    class M_excel extends Database {

        function exportExcel($tableName) {
            $query = "SELECT * FROM $tableName ORDER BY id DESC";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }
    }
?>