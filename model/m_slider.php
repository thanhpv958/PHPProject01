<?php
    require_once '../config/database.php';

    class M_slider extends Database {

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
    }
?>