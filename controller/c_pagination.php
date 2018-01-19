<?php
    require_once '../model/m_pagination.php';

    class C_pagination {
        
        protected $_config = array(
            'current_page'  => 1, 
            'limit'         => 2, 
            'link_full'     => 'listVideo.php?page={page}',
            'link_first'    => 'listVideo.php',
            'tableName'         => ''
        );
        
        protected $totalRecord; // tổng bản ghi
        protected $total_page; // trong trang
        protected $start; // vị trí bắt đầu lấy
        
        public function init($config = []) {
            foreach ($config as $key => $value) {
               if(isset($this->_config[$key]))
                    $this->_config[$key] = $value;
                else
                    echo 'error';
            }
            $m_pagination = new M_pagination();
            $this->totalRecord = $m_pagination->countRowData($this->_config['tableName']); // tổng bản ghi = số lượng bản ghi trong database
            
            if($this->_config['limit'] < 0)  // nếu limit < 0 thì limit bằng 0
                $this->_config['limit'] = 0;
            
            $this->total_page = ceil($this->totalRecord / $this->_config['limit']); // tổng trang = tổng bản ghi / limit
            
            if($this->total_page < 0)
                $this->total_page = 1;
            
            if($this->_config['current_page'] > $this->total_page)
                $this->_config['current_page'] = $this->total_page;
            else if ($this->_config['current_page'] < 0)
                $this->_config['current_page'] = 1;

            $this->start = ($this->_config['current_page'] - 1) * $this->_config['limit'];
            /*
                * = số lượng trang hiện tại - 1 * với limit
                * Ex: Trang 2: 2-1 * 2 = 2 -> vị trí bắt đầu lấy từ bản ghi số 2 trong database
            */
            

        }

        private function link($page) {  
            if ($page <= 1){
                return $this->_config['link_first'];
            }
            return str_replace('{page}', $page, $this->_config['link_full']);
        }

        public function html() {
            $p ='';
            $p .= '<ul class="pagination justify-content-center">';

                if( $this->_config['current_page'] > 1 && $this->total_page > 1 )
                    $p .= '<li class="page-item"><a class="page-link" href="'. $this->link( $this->_config['current_page'] -1 ).'">Prev</a></li>';
                for ($i=1; $i <= $this->total_page; $i++ ) { 
                    if($i == $this->_config['current_page'])
                        $p .= '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
                    else
                        $p .= '<li class="page-item"><a class="page-link" href="'. $this->link( $i ) .'">'. $i .'</a></li>';
                }
                if( $this->_config['current_page'] < $this->total_page && $this->total_page > 1 )
                    $p .= '<li class="page-item"><a class="page-link" href="'. $this->link( $this->_config['current_page'] +1 ).'">Next</a></li>';
            $p .= '</ul>';   
            return $p;   
        }

        public function getData() {
            $m_pagination = new M_pagination();
            return $m_pagination->pagination($this->_config['tableName'], $this->start, $this->_config['limit']);  
        }

    }
?>