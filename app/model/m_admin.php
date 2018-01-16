<?php
    require_once '../../config/database.php';

    class M_admin extends Database {

        public function selectFromTable($tableName)
        {
            $query = "SELECT * FROM $tableName ORDER BY id ASC";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }

        public function deleteDataByID($tableName, $id)
        {
            $query = "DELETE FROM $tableName WHERE id='$id'";
            return $this->setQuery($query);
        }

        public function getDataByID($tableName, $id)
        {
            $query = "SELECT * FROM $tableName WHERE id='$id'";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }
        //video

        public function addVideo($title, $link, $ordernum, $onstatus)
        {
            $query = "INSERT INTO video (title, link, ordernum, onstatus) VALUES ('$title', '$link', $ordernum, $onstatus)";
            return $this->setQuery($query);
        }

        
        
        

        public function editVideo($id, $title, $link, $ordernum, $status)
        {
            $query = "UPDATE video SET title='$title', link='$link', ordernum='$ordernum', onstatus='$status' WHERE id='$id'";
            return $this->setQuery($query);
        }


        //SLIDER
        
        public function addSlider($title, $image, $link, $ordernum, $onstatus)
        {
            $query = "INSERT INTO slider (title, imageSlider, link, ordernum, onstatus) VALUES ('$title', '$image', '$link', $ordernum, $onstatus)";
            return $this->setQuery($query);
        }

        public function editSlider($id, $title, $image, $link, $ordernum, $status)
        {
            $query = "UPDATE slider SET title='$title', imageSlider='$image',link='$link', ordernum='$ordernum', onstatus='$status' WHERE id='$id'";
            return $this->setQuery($query);
        }

        // USER LOGIN
        public function userLogin($username, $password) {
            $query = "SELECT username, password, status FROM user WHERE username='$username' AND password='$password'";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }

        public function userSignup($email, $username, $password) {
            $query = "INSERT INTO user (email, username, password, status) VALUES ('$email', '$username', '$password', '1')";
            return $this->setQuery($query);
        }

        public function userExist($username) {
            $query = "SELECT username FROM user WHERE username='$username'";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }

        public function emailExist($email) {
            $query = "SELECT email FROM user WHERE email='$email'";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }

        //Pagination
        public function countRowData($tableName) {
            $query = "SELECT COUNT(id) FROM $tableName";
            $this->setQuery($query);
            return $this->countRow();
        }
        public function pagination($tableName, $start, $limit) {
            $query = "SELECT * FROM $tableName ORDER BY id ASC LIMIT $start, $limit";
            $this->setQuery($query);
            return $this->loaddAllRows();
        }
    }
?>