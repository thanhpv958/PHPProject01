<?php session_start();
    if( !isset($_SESSION['uid']) )
        header('location: ./login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/admin/style.css">
    <link rel="shortcut icon" href="../../public/img/admin-favicon.png">
    <title>ADMINISTRATOR - ThanhPhan</title>
</head>
<body>
    <div class="container-fluid">
        <div class="header">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                        aria-expanded="false" aria-label="Toggle navigation"></button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search">
                        </form>
                        <a class="nav-link offset-4" href="#">ADMINISTRATOR SYSTEM</a>
                        <ul class="navbar-nav ml-auto">
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <!-- <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"> </div> -->
                                    <span class="name">Hi, <?php if(isset($_SESSION['uid'])) echo $_SESSION['uid'] ?> </span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-user icon"></i> Profile </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-bell icon"></i> Notifications </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-gear icon"></i> Settings </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./logout.php">
                                        <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>   
            </div> <!-- end header -->
    </div> <!-- end container -->