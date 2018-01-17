<?php
    require_once '../model/m_article.php';
    require_once '../controller/c_admin.php';
    class C_article extends C_admin {

        function addArticle($title, $body, $category, $image, $time, $status) {
            $errors = [];
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                if( empty($title) ) {
                    echo $errors['title'] = '<p class="errorField">You should enter title</p>';     
                }

                if( empty($body) ) {
                    echo $errors['body'] = '<p class="errorField">You should enter body</p>';
                } 
                
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
    }
?>