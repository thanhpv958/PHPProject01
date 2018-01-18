<?php
    require_once '../model/m_article.php';
    require_once '../controller/c_admin.php';
    require_once '../controller/c_pagination.php';
    class C_article extends C_admin  {

        protected $configP;

        function addArticle($title, $body, $category, $image, $time, $status) {
            $errors = [];
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                if( empty($title) ) {
                    echo $errors['title'] = '<p class="errorField">You should enter title</p>';     
                }

                if( empty($body) ) {
                    echo $errors['body'] = '<p class="errorField">You should enter body</p>';
                } 
                
                // category
                $m_article = new M_article();
                $resultQueryCat = $m_article->showNameCategory($category);
                $category = $resultQueryCat[0]['title'];
                

                if( $image['size'] < 0 ) {
                    echo $errors['image'] = '<p class="errorField">You should enter image</p>';  

                } else {
                    $flagSize = $this->checkFileSize($image['size'], 5, 5242880);
                    $flagExt = $this->checkFileExt($image['name'], ['jpg', 'png', 'jpeg', 'gif']);
                    if($flagExt && $flagExt) {
                        $dir = '../../public/fileUpload/';
                        $randomStr = substr( md5(time() *134), 0, 4);  // tránh upload trùng tên file
                        $imageArticle =  $randomStr .'-'. $image['name'];
                        move_uploaded_file($image['tmp_name'], $dir . $imageArticle);
                    } else {
                        echo $errors['image'] = 'Check file size or extension';
                    }
                }  
                
                if(empty($errors)) {
                    $m_article = new M_article();
                    return $m_article->addArticle($title, $body, $category, $imageArticle, $time, $status);       
                }
            }
        }

       

        public function configPagination($page) {
            if( filter_var($page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                die('Fail. Please check infomation or contact admin');
            } else {
                $this->configP = [
                    'current_page'  => $page, 
                    'limit'         => 10, 
                    'link_full'     => 'listArticle.php?page={page}',
                    'link_first'    => 'listArticle.php',
                    'tableName'         => 'article'
                ];
            }
            
        }

        public function getAllArticleP() {
            $c_pagination = new C_pagination();
            $c_pagination->init($this->configP);
            return $c_pagination->getData();
        }

        public function showPagination() {
            $c_pagination = new C_pagination();
            $c_pagination->init($this->configP);
            return $c_pagination->html();
        }


    }
?>