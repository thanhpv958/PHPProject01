<?php
    require_once '../model/m_article.php';
    require_once '../model/m_process.php';
    require_once '../controller/c_process.php';
    require_once '../controller/c_pagination.php';
    class C_article   {

        private $configP;

        public function configPagination($page, $linkPage) {
            if( filter_var($page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                die('Fail. Please check infomation or contact admin');
            } else {
                $this->configP = [
                    'current_page'  => $page, 
                    'limit'         => 6, 
                    'link_full'     => "$linkPage.php?page={page}",
                    'link_first'    => "$linkPage.php",
                    'tableName'         => 'article'
                ];
            }
            
        }

        function addArticle($title, $body, $category, $image, $time, $status) {
            $errors = [];
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                if( empty($title) ) {
                    echo $errors['title'] = '<p class="errorField">You should enter title</p>';     
                }

                if( empty($body) ) {
                    echo $errors['body'] = '<p class="errorField">You should enter body</p>';
                } else {
                    $body = htmlspecialchars($body);
                } 
                // category
                // $m_article = new M_article();
                // $resultQueryCat = $m_article->showNameCategory($category);
                // $category = $resultQueryCat[0]['title'];
                

                if( $image['size'] < 0 ) {
                    echo $errors['image'] = '<p class="errorField">Check your image (source, extension or size)</p>';  
                } else {
                    $c_process = new C_process();
                    $flagSize = $c_process->checkFileSize($image['size'], 5, 5242880);
                    $flagExt = $c_process->checkFileExt($image['name'], ['jpg', 'png', 'jpeg', 'gif']);
                    if($flagExt && $flagExt) {
                        $dir = '../public/fileUpload/';
                        $randomStr = substr( md5(time() *134), 0, 4);  // tránh upload trùng tên file
                        $imageArticle =  $randomStr .'-'. $image['name'];
                        move_uploaded_file($image['tmp_name'], $dir . $imageArticle);
                    } else {
                        echo $errors['image'] = '<p class="errorField">Check your image (source, extension or size)</p>';
                    }
                }  
                
                if(empty($errors)) {
                    $m_article = new M_article();
                    return $m_article->addArticle($title, $body, $category, $imageArticle, $time, $status);       
                }
            }
        }    

        public function getAllArticleP() {
            $c_pagination = new C_pagination();
            $c_pagination->init($this->configP);
            return $c_pagination->getData();
        }

        public function getArticleByID($id) {
            if( filter_var($id, FILTER_VALIDATE_INT) == false) {
                header('location: ../admin/listArticle.php');
            } else {
                $m_process = new M_process();
                return $m_process->getDataByID('article', $id);
            }
        }

        // public function getArticleByCat($id) {
        //     if( filter_var($id, FILTER_VALIDATE_INT) == false) {
        //         header('location: ../admin/listArticle.php');
        //     } else {
        //         $m_article = new M_article();
        //         return $m_article->getArticleByCat($id);
        //     }
        // }

        public function getArticleByCat($id) {
            if( filter_var($id, FILTER_VALIDATE_INT) == false) {
                header('location: ../admin/listArticle.php');
            } else {
                $c_pagination = new C_pagination();
                $c_pagination->init($this->configP);
                return $c_pagination->getArticleByCat($id);
            }
        }

        public function showPagination() {
            $c_pagination = new C_pagination();
            $c_pagination->init($this->configP);
            return $c_pagination->html();
        }

        public function editArticle($id, $title, $body, $category, $image, $imageEdit, $status) {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'fail';
            } else {
                $errors=[];
                if($_SERVER['REQUEST_METHOD'] ==  'POST') {

                    if( empty($title) ) {
                        echo $errors['title'] = '<p class="errorAddVideo">You can should title</p>';     
                    }
    
                    if( empty($body) ) {
                        echo $errors['body'] = '<p class="errorAddVideo">You can should link</p>';
                    } 

                    $m_article = new M_article();
                    $resultQueryCat = $m_article->showNameCategory($category);
                    $category = $resultQueryCat[0]['title'];

                    if($imageEdit['size'] > 0) {
                        $c_process = new C_process();
                        $flagSize = $c_process->checkFileSize($imageEdit['size'], 5, 5242880);
                        $flagExt = $c_process->checkFileExt($imageEdit['name'], ['jpg', 'png', 'jpeg', 'gif']);
                        if($flagSize && $flagExt) {
                            $dir = '../public/fileUpload/';
                            $imageArticle = substr(md5(time() * 134), 0, 4) .'-'. $imageEdit['name'];
                            move_uploaded_file( $imageEdit['tmp_name'], $dir . $imageArticle);
                            unlink($dir.$image);
                        } else {
                            echo $errors['image'] = 'Check your image';
                        }
                    } else {
                        $imageArticle = $image;
                    }

                    if( empty($errors)) {
                        $m_article = new M_article();
                        $m_article->editArticle($id, $title, $body, $category, $imageArticle, $status);
                        header('location: ../admin/listArticle.php');
                        return;
                    }
                }
            }
        }

        public function deleteArticleByID($id) {
            if( filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                die('FAIL');
            } else {
                $dataArticle = $this->getArticleByID($id);
                foreach ($dataArticle as $value) {
                    $image = '../public/fileUpload/' . $value['image'];
                }
                $m_process = new M_process();
                $m_process->deleteDataByID('article', $id);

                if( file_exists($image) ) { 
                    unlink($image);
                }
                return header('location: ../admin/listArticle.php');      
            }
        }

        function showNameCategory($id) {
          $m_article = new M_article();
          $nameCat = $m_article->showNameCategory($id);
          return $nameCat[0]['title'];
        }

    }
?>