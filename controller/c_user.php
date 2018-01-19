<?php
    require_once '../model/m_user.php';

    class C_user {

        public function userLogin($username, $password)
        {     
            $password = md5($password);
            $m_user = new M_user();
            $resultUser = $m_user->userLogin($username, $password);
            if($resultUser) {
                $_SESSION['uid'] = $resultUser['id'];
                $_SESSION['username'] = $resultUser['username'];
                header('location: ../admin/index.php'); 
            } else {
                echo 'User not exist or not active. Please contact admin';
             }
        }

        public function userSignup($email, $username, $password, $repass)
        {
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