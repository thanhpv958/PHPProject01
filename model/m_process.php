<?php
    require_once '../config/database.php';

    class M_process extends Database {

        public function selectFromTable($tableName)
        {
            $query = "SELECT * FROM $tableName ORDER BY id ASC";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }

        public function deleteDataByID($tableName, $id)
        {
            $query = "DELETE FROM $tableName WHERE id=$id";
            return $this->setQuery($query);
        }

        public function getDataByID($tableName, $id)
        {
            $query = "SELECT * FROM $tableName WHERE id='$id'";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }
       
    }
?>