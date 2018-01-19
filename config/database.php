<?php
    class Database
    {
        private $connect;
        private $query;

        public function Database()
        {
            $this->connect = mysqli_connect('localhost', 'root', '', 'phplearnblog');
            mysqli_set_charset($this->connect, 'utf8');
            return $this->connect;
        }

        public function setQuery($query)
        {
            return $this->query = mysqli_query($this->connect, $query);
        }

        // public function affectedRows()
        // {
        //     if(mysqli_affected_rows($connect) ==1)
        //         return true;
        //     return false;
        // }
        public function countRow() {
            list($record) = mysqli_fetch_array($this->query, MYSQLI_NUM);
            return $record;
        }
        public function loaddAllRows()
        {
            $result  = [];
            if(mysqli_num_rows($this->query) > 0)
                while($row = mysqli_fetch_assoc($this->query))
                    $result[] = $row;
            return $result;          
        }

       
    }

    
   
?>