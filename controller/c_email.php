<?php
    require_once '../lib/PHPmailer/PHPMailer.php';
    require_once 'c_pagination.php';
    require_once '../model/m_email.php';
    class C_email {

        public function configPagination($page, $linkPage) {
            if( filter_var($page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                die('Fail. Please check infomation or contact admin');
            } else {
                $this->configP = [
                    'current_page'  => $page, 
                    'limit'         => 6, 
                    'link_full'     => "$linkPage.php?page={page}",
                    'link_first'    => "$linkPage.php",
                    'tableName'         => 'email'
                ];
            }   
        }

        function sendEmail($user_id, $sendTo, $subject, $body, $time) {
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $sendTo = trim($sendTo);
            $sendTo = explode(',', $sendTo);
            
            $sendToValidate = [];

            foreach ($sendTo as $key => $value) {
                if(filter_var(trim($value), FILTER_VALIDATE_EMAIL) == false) {
                    die( "<script>alert('Check your email')</script>");     
                } else {
                    $sendToValidate[$key] = $value;
                };  
            }
           
            foreach ($sendToValidate as $st) {
                $mail->AddAddress( trim($st) );       
            }
            
            $subject = trim($subject);
           
            $mail->CharSet = 'utf-8';
            $mail->SetFrom('martinrichard9598@gmail.com', 'Thanh Phan');
            
            $mail->Subject = $subject;
            $mail->MsgHTML($body);
           
            if($mail->send() == false) {
                echo 'Error' . $mail->ErrorInfo;
            } else {
                echo "<script>confirm('Send mail successful')</script>";
                $m_email = new M_email();
                $m_email->sendEmail($user_id, $sendTo, $subject, $body, $time);
                header('location: ../admin/listEmail.php');
            }
        }

        public function getAllEmailP() {
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