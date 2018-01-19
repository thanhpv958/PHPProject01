<?php
    require_once '../config/database.php';
    
    class M_video extends Database {

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
    }
?>