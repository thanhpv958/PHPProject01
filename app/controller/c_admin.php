<?php
    
    require_once '../model/m_admin.php';
    class C_admin {
        
        // function process
        public function checkFileSize($size, $minSize, $maxSize)
        {
            if($size > $minSize && $size < $maxSize)
                return true;
            return false;
        }

        public function checkFileExt($fileName, $arrExt)
        {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            if( in_array(strtolower($ext), $arrExt ) )
                return true;
            return false;
        }

        

        //Video
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
                    $m_admin = new M_admin();
                    $m_admin->addVideo($title, $link, $ordernum, $status);
                    header('location: ../admin/listVideo.php');
                    return;
                }
            }
        }

        public function getAllVideo($start, $per_page)
        {
            $limit = 4;
            $m_admin = new M_admin();
            // $m_admin->pagination('video');
            
            if( !isset($start) && filter_var($start, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                $startData = 0;
            } else {
               $startData = $start;
            }

            if( !isset($per_page) && filter_var($per_page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                $record = $m_admin->countRowData('video');
                if( $record > $limit)
                    $per_pageData = ceil($record/$limit);
                else {
                    $per_pageData = 1;
                }
            } else {
               $per_pageData = $per_page;
            }
        }

        public function getVideoByID($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_admin = new M_admin();
                return $m_admin->getDataByID($id); 
            }
            
        }

        public function deleteVideoById($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_admin = new M_admin();
                $m_admin->deleteDataByID('video',$id);
                header('location: ../admin/listVideo.php');
                return;
            }
        }

        public function editVideo($id, $title, $link, $ordernum, $status)
        {
            
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'fail';
            } else {
                $m_admin = new M_admin();
                $m_admin->editVideo($id, $title, $link, $ordernum, $status);
                header('location: ./listVideo.php'); 
                return;
            }
        }

        //Slider

        public function getAllSlider()
        {
            $m_admin = new M_admin();
            return $m_admin->selectFromTable('slider');    
        }

        public function getSliderByID($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_admin = new M_admin();
                return $m_admin->getDataByID('slider', $id); 
            }
            
        }

        public function addSlider($title, $image, $link, $ordernum, $status)
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

                if( $image['size'] < 0 ) {
                    echo $errors['image'] = '<p class="errorAddVideo">You should enter image</p>';  

                } else {
                    $flagSize = $this->checkFileSize($image['size'], 5, 5242880);
                    $flagExt = $this->checkFileExt($image['name'], ['jpg', 'png', 'jpeg', 'gif']);
                    if($flagExt && $flagExt) {
                        $dir = '../../public/fileUpload/';
                        $randomStr = substr( md5(time() *134), 0, 4);  // tránh upload trùng tên file
                        $imageSlider =  $randomStr .'-'. $image['name'];
                        move_uploaded_file($image['tmp_name'], $dir . $imageSlider);
                    } else {
                        die('Check file size or extension');
                    }
                }  
                if(empty($errors)) {
                    $m_admin = new M_admin();
                    $m_admin->addSlider($title, $imageSlider, $link, $ordernum, $status);
                    header('location: ../admin/listSlider.php');
                    return;
                }
            } else {
                die('FAIL');
            }
        }

        public function deleteSliderById($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                die('FAIL');
            } else {
                $dataSlider = $this->getSliderByID($id);
                foreach ($dataSlider as $value) {
                    $image = '../../public/fileUpload/' . $value['imageSlider'];
                }
                $m_admin = new M_admin();
                $m_admin->deleteDataByID('slider', $id);

                if( file_exists($image) ) { 
                    unlink($image);
                }

                header('location: ../admin/listSlider.php');
                return;
            }
            
        }

        public function editSlider($id, $title, $image, $imageEdit, $link, $ordernum, $status)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'fail';
            } else {
                $errors= [];
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

                    if($imageEdit['size'] > 0) {
                        $flagSize = $this->checkFileSize($imageEdit['size'], 5, 5242880);
                        $flagExt = $this->checkFileExt($imageEdit['name'], ['jpg', 'png', 'jpeg', 'gif']);
                        if($flagSize && $flagExt) {
                            $dir = '../../public/fileUpload/';
                            $randomStr = substr( md5(time() *134), 0, 4);  // tránh upload trùng tên file
                            $imageSlider =  $randomStr .'-'. $imageEdit['name'];
                            move_uploaded_file($imageEdit['tmp_name'], $dir . $imageSlider);
                            unlink('../../public/fileUpload/' . $image);
                        } else {
                            die('Check file size or extension');
                        }
                    } else {
                        $imageSlider = $image;
                    }
                   
                    if(empty($errors)) {
                        $m_admin = new M_admin();
                        $m_admin->editSlider($id, $title, $imageSlider, $link, $ordernum, $status);
                        header('location: ../admin/listSlider.php');
                        return;
                    }
                } else {
                    die('FAIL');
                }
            }
        }


        // USER LOGIN
        public function userLogin($username, $password) {
            
            $password = md5($password);

            $M_admin = new M_admin();
            $result = $M_admin->userLogin($username, $password);
            if($result) {
                foreach ($result as $value) {
                    $_SESSION['uid'] = $value['username'];
                }
                header('location: ../admin/index.php');
            } else {
                echo 'User not exist or not active. Please contact admin';
             }
        }

        public function userSignup($email, $username, $password, $repass) {
            $M_admin = new M_admin();
            $errors = [];
            $userData = $M_admin->userExist($username);
            $emailData = $M_admin->emailExist($email);

            if($userData) echo $errors['userExisted'] = 'Username existed</br>';
            if($emailData) echo $errors['emailExisted'] = 'Email existed</br>';

            if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                echo $errors['emailIncorrect'] ='Email incorrect</br>';
            } else {
               $emailData = $email;
            }
           
            if($password != $repass) {
                echo $errors['passIncorrect'] ='Repassword incorrect</br>';
            } else {
                $passData = md5($password);
            }
            
            if( empty($errors) ) {
                if( $M_admin->userSignup($emailData,$username, $passData)) {
                    echo 'You registed successful';
                    return true;
                }  else {
                    echo 'Error. Please check infomation or contact admin';
                    return false;
                }
            }
           
            
        }

        public function getAllUser()
        {
            $m_admin = new M_admin();
            return $m_admin->selectFromTable('user');    
        }

        public function deleteUserById($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_admin = new M_admin();
                $m_admin->deleteDataByID('user',$id);
                header('location: ../admin/listUser.php');
                return;
            }
        }
    }
 
?>