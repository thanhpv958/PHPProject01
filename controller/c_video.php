<?php
    require_once 'c_pagination.php';
    require_once '../model/m_process.php';
    require_once '../controller/c_excel.php';
    require_once '../model/m_video.php';
    class C_video extends C_pagination{

        protected $configP;

        public function configPagination($page) {
            if( filter_var($page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                die('Fail. Please check infomation or contact admin');
            } else {
                $this->configP = [
                    'current_page'  => $page, 
                    'limit'         => 6, 
                    'link_full'     => 'listVideo.php?page={page}',
                    'link_first'    => 'listVideo.php',
                    'tableName'         => 'video'
                ];
            }
            
        }
        public function getAllVideoP() {
            $this->init($this->configP);
            return $this->getData();
        }

        public function showPagination() {
            $this->init($this->configP);
            return $this->html();
        }

        public function addVideo($title, $link, $ordernum, $status)
        {
            $errors = [];
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if( empty($title) ) {
                    echo $errors['title'] = '<p class="errorAddVideo">You can should title</p>';     
                }

                if( empty($link) ) {
                    echo $errors['link'] = '<p class="errorAddVideo">You can should link</p>';
                } 
                
                if( empty($ordernum) ) {
                    echo $errors['ordernum'] = '<p class="errorAddVideo">You should enter ordernum</p>';
                }
                if(empty($errors)) {
                    $m_video = new M_video();
                    $m_video->addVideo($title, $link, $ordernum, $status);
                    header('location: ../admin/listVideo.php');
                    return;
                }
            }
        }

        // public function getAllVideo($start, $per_page)
        // {
        //     $limit = 4;
        //     $m_admin = new M_admin();
        //     // $m_admin->pagination('video');
            
        //     if( !isset($start) && filter_var($start, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
        //         $startData = 0;
        //     } else {
        //        $startData = $start;
        //     }

        //     if( !isset($per_page) && filter_var($per_page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
        //         $record = $m_admin->countRowData('video');
        //         if( $record > $limit)
        //             $per_pageData = ceil($record/$limit);
        //         else {
        //             $per_pageData = 1;
        //         }
        //     } else {
        //        $per_pageData = $per_page;
        //     }
        // }

        public function getVideoByID($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_process = new M_process();
                return $m_process->getDataByID('video', $id); 
            }
            
        }

        public function deleteVideoById($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_process = new M_process();
                $m_process->deleteDataByID('video',$id);
                header('location: ../admin/listVideo.php');
                return;
            }
        }

        public function editVideo($id, $title, $link, $status)
        {   
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'fail';
            } else {
                $m_video = new M_video();
                $m_video->editVideo($id, $title, $link, $ordernum, $status);
                header('location: ./listVideo.php'); 
                return;
            }
        }

        public function exportExcelVideo() {
            $output = '
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th colspan="4">Danh sách video</th>
                        </tr>           
                        <tr>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Status</th>
                        </tr>
                    </thead>
            ';

            $c_excel = new C_excel();
            $listVideo = $c_excel->exportExcel('video');
            $output .= '<tbody>';
            foreach ($listVideo as  $video) {
                $output .= '
                    <tr>
                        <td>'.$video['title'].'</td>
                        <td>'.$video['link'].'</td>
                        <td>'.$video['onstatus'].'</td>
                    </tr>    
                ';
            }
            $output .= '</tbody>';
            $output .= '</table>';
            header('Content-type: application/xls');
            header('Content-Disposition: attachment; filename=listVideo.xls');
            echo $output;
        }
    }
    
?>