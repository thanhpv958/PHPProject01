<?php
    require_once '../config/database.php';

    class M_email extends Database {

        function sendEmail($user_id, $sendTo, $subject, $body, $time) {
            $query = "INSERT INTO email (user_id, sendto, subject, body, time) VALUES ($user_id, '$sendTo', '$subject', '$body', '$time' )";
            return $this->setQuery($query);
        }
    }
?>