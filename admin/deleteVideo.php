<?php
    require_once '../controller/c_video.php';
    $c_video = new C_video();
    $c_video->deleteVideoById($_GET['id']);
?>