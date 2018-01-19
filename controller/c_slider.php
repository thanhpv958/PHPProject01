<?php
    require_once '../controller/c_process.php';
    require_once '../model/m_slider.php';
    require_once '../model/m_process.php';
    class C_slider {
        
        public function getAllSlider()
        {
            $m_slider = new M_process();
            return $m_slider->selectFromTable('slider');    
        }

        public function getSliderByID($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_process = new M_process();
                return $m_process->getDataByID('slider', $id); 
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
                    $c_process = new C_process();
                    $flagSize = $c_process->checkFileSize($image['size'], 5, 5242880);
                    $flagExt = $c_process->checkFileExt($image['name'], ['jpg', 'png', 'jpeg', 'gif']);
                    if($flagExt && $flagExt) {
                        $dir = '../public/fileUpload/';
                        $randomStr = substr( md5(time() *134), 0, 4);  // tránh upload trùng tên file
                        $imageSlider =  $randomStr .'-'. $image['name'];
                        move_uploaded_file($image['tmp_name'], $dir . $imageSlider);
                    } else {
                        die('Check file size or extension');
                    }
                }  
                if(empty($errors)) {
                    $m_slider = new M_slider();
                    $m_slider->addSlider($title, $imageSlider, $link, $ordernum, $status);
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
                    $image = '../public/fileUpload/' . $value['imageSlider'];
                }
                $m_process = new M_process();
                $m_process->deleteDataByID('slider', $id);

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
                        $c_process = new C_process();
                        $flagSize = $c_process->checkFileSize($imageEdit['size'], 5, 5242880);
                        $flagExt = $c_process->checkFileExt($imageEdit['name'], ['jpg', 'png', 'jpeg', 'gif']);
                        if($flagSize && $flagExt) {
                            $dir = '../public/fileUpload/';
                            $randomStr = substr( md5(time() *134), 0, 4);  // tránh upload trùng tên file
                            $imageSlider =  $randomStr .'-'. $imageEdit['name'];
                            move_uploaded_file($imageEdit['tmp_name'], $dir . $imageSlider);
                            unlink('../public/fileUpload/' . $image);
                        } else {
                            die('Check file size or extension');
                        }
                    } else {
                        $imageSlider = $image;
                    }
                   
                    if(empty($errors)) {
                        $editSlider = new M_slider();
                        $editSlider->editSlider($id, $title, $imageSlider, $link, $ordernum, $status);
                        header('location: ../admin/listSlider.php');
                        return;
                    }
                } else {
                    die('FAIL');
                }
            }
        }

    }
?>