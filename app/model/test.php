<?php
    require_once './m_admin.php';
    $test = new M_admin();
    $abc = $test->countRowData('video');
    echo '<pre>';
    print_r($abc);
    echo '</pre>';