<?php
    // require_once './m_user.php';
    // $test = new M_user();
    // $abc = $test->userLogin('thanhpv958', '0849a2921810983c0ad3757e199e3b94');
    
    // echo '<pre>';
    // print_r($abc);
    // echo '</pre>';
    require_once './m_pagination.php';
    $abc = new M_pagination();
    echo '<pre>';
    print_r($abc->pagination('article', 0, 6));
    echo '</pre>';