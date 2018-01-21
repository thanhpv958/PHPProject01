<?php
    require_once '../controller/c_video.php';
    $c_video = new C_video();
    return $c_video->exportExcelVideo();
?>