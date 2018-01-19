<?php
    session_start();
    if(isset($_SESSION['username']))
        header('location: ./index.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="shortcut icon" href="../public/img/admin-favicon.png">
    <title>User Login</title>
</head>
<body>
    <div class="login">
        
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h2 class="text-center text-white pb-4">User Login</h2> -->
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <span class="anchor" id="formLogin"></span>

                            <!-- form card login -->
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <?php
                                        require_once '../controller/c_user.php';
                                        if( isset($_POST['username']) && isset($_POST['password']) ) {
                                            $c_user = new C_user();
                                            $c_user->userLogin($_POST['username'], $_POST['password']);  
                                        }
                                    ?>
                                    <h3 class="pb-0">Login</h3>
                                    <a href="./signup.php" class="linkAccount float-right" >Create your account</a>
                                </div>
                                <div class="card-body">
                                    
                                    <form class="form" id="formLogin" method="POST">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control form-control-lg rounded-0" name="username" id="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control form-control-lg rounded-0" name="password" id="password" required>
                                        </div>
                                        <div>
                                            <label class="custom-control  custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" >
                                                <span class="custom-control-indicator"></span>
                                                <span>Remember me on this computer</span>
                                            </label>
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