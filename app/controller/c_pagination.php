<?php
    require_once '../model/m_admin.php';

    class C_pagination {
        
        protected $_config = array(
            'current_page'  => 1, 
            'limit'         => 2, 
            'link_full'     => 'listVideo.php?page={page}',
            'link_first'    => 'listVideo.php',
            'tableName'         => ''
        );
        
        protected $totalRecord;
        protected $total_page;
        

        public function init($config = []) {
            foreach ($config as $key => $value) {
               if(isset($this->_config[$key]))
                    $this->_config[$key] = $value;
                else
                    echo 'error';
            }
            

            $M_admin = new M_admin();
            $this->totalRecord = $M_admin->countRowData($this->_config['tableName']);

           

            if($this->_config['limit'] < 0)
                $this->_config['limit'] = 0;
            
            $this->total_page = ceil($this->totalRecord / $this->_config['limit']);
            
            if($this->total_page < 0)
                $this->total_page = 1;
            
            if($this->_config['current_page'] > $this->total_page)
                $this->_config['current_page'] = $this->total_page;
            else if ($this->_config['current_page'] < 0)
                $this->_config['current_page'] = 1;

            $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];

        }

        public function getData() {
            $M_admin = new M_admin();
            return $M_admin->pagination($this->_config['tableName'], $this->_config['start'], $this->_config['limit']);  
        }

        private function link($page) {
            // Nếu trang < 1 thì ta sẽ lấy link first
            if ($page <= 1){
                return $this->_config['link_first'];
            }
            // Ngược lại ta lấy link_full
            // Như tôi comment ở trên, link full có dạng domain.com/page/{page}.
            // Trong đó {page} là nơi bạn muốn số trang sẽ thay thế vào
            return str_replace('{page}', $page, $this->_config['link_full']);
        }

        public function html() {
            $p ='';
            $p .= '<ul class="pagination">';

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
    }
?>