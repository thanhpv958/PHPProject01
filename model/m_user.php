<?php
    require_once '../config/database.php';

    class M_user extends Database {
        
        public function userLogin($username, $password) {
            $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
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
    }
?>