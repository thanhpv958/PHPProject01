<?php
    require_once '../controller/c_admin.php';
    $C_admin = new C_admin();
    $C_admin->deleteSliderById($_GET['id']);
?>