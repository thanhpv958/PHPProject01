<?php
    session_start();
    if( isset($_SESSION['uid']) )
        header('location: ./index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="shortcut icon" href="../../public/img/admin-favicon.png">
    <title>User Register</title>
</head>
<body>
    <div class="login">
        
        <div class="container pt-5">
            <div class="row">
                <div class="col-sm-12">
                    <!-- <h2 class="text-center text-white pb-4">User Register</h2> -->
                    <div class="row">
                        <div class="col-sm-6 mx-auto">
                            <span class="anchor" id="formLogin"></span>

                            <!-- form card login -->
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <h3 class="pb-0">Register</h3>
                                    <a href="./login.php" class="linkAccount float-right" >Login</a>

                                    <?php
                                        require_once '../controller/c_admin.php';
                                        if( isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) ) {
                                            $C_admin = new C_admin();
                                            if($C_admin->userSignup($_POST['email'], $_POST['username'], $_POST['password'], $_POST['repassword'])) {
                                                $_POST['email'] = "";
                                                $_POST['username'] = "";
                                            };                                                                        
                                        }
                                    ?>
                                </div>
                                <div class="card-body">
                                    
                                    <form class="form" id="formLogin" method="POST">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control form-control-lg rounded-0" name="email" id="email" 
                                                    value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" required >
                                        </div>

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control form-control-lg rounded-0" name="username" id="username" 
                                                    value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control form-control-lg rounded-0" name="password" id="password" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="repassword">Repassword</label>
                                            <input type="password" class="form-control form-control-lg rounded-0" name="repassword" id="repassword" required >
                                        </div>
                                        
                                        <a href="#" class="linkPassword float-left">Forgot Password</a>
                                        <button  class="btn btn-success btn-lg float-right">Login</button>
    
                                    </form>
                                   
                                </div>
                                <!--/card-block-->
                            </div>
                            <!-- /form card login -->
                            
                        </div>


                    </div>
                    <!--/row-->

                </div>
                <!--/col-->
            </div>
            <!--/row-->
        </div>
        <!--/container-->
    </div>
</body>
</html>