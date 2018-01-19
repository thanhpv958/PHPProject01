<?php
    require_once '../controller/c_slider.php';
    $c_slider = new C_slider();
    $c_slider->deleteSliderById($_GET['id']);
?>