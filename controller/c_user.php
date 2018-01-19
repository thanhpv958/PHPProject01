<?php
    require_once '../model/m_user.php';
    require_once '../model/m_process.php';
    class C_user {

        public function userLogin($username, $password)
        {     
            $password = md5($password);
            $m_user = new M_user();
            $resultUser = $m_user->userLogin($username, $password);
            if($resultUser) {
                foreach($resultUser as $user) {
                    $_SESSION['uid'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                }
                header('location: ../admin/index.php'); 
            } else {
                echo 'User not exist or not active. Please contact admin';
             }
        }

        public function userSignup($email, $username, $password, $repass)
        {
            $m_user = new M_user();
            $errors = [];
            $userData = $m_user->userExist($username);
            $emailData = $m_user->emailExist($email);

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
                if( $m_user->userSignup($emailData,$username, $passData)) {
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
            $m_process = new M_process();
            return $m_process->selectFromTable('user');    
        }

        public function deleteUserById($id)
        {
            if( !isset($id) && filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ]) == false ) {
                echo 'FAIL';
            } else {
                $m_process = new M_process();
                $m_process->deleteDataByID('user',$id);
                header('location: ../admin/listUser.php');
                return;
            }
        }
    }
?>