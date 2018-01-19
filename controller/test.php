<?php
    require_once './c_user.php';
    $a = new C_user();
    // $abc =$a->listVideo();
    // echo '<pre>';
    // print_r($abc);
    // echo '</pre>';
    $abc = $a->userLogin('thanhpv958', '0849a2921810983c0ad3757e199e3b94');
    echo '<pre>';
    print_r($abc);
    echo '</pre>';