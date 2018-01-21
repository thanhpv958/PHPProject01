<?php
    require_once '../model/m_excel.php';
    class C_excel {

        // public $output = '
        //     <table class="table">
        //         <thread>
        //             <th>ID</th>
        //             <th>Title</th>
        //             <th>Link</th>
        //             <th>Status</th>
        //         </thread>
        // ';

        function exportExcel($tableName) {
            $m_excel = new M_excel();
            return $m_excel->exportExcel($tableName);
        }
    }
?>