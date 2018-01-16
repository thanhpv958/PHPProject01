<?php
    require_once 'c_pagination.php';
    class c_video extends C_pagination{

        protected $configP;

        public function configPagination($page) {
            if( filter_var($page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                die('Fail. Please check infomation or contact admin');
            } else {
                $this->configP = [
                    'current_page'  => $page, 
                    'limit'         => 4, 
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
    }
    
?>