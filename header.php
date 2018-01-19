
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/site/style.css">
    <link rel="shortcut icon" href="../../public/img/admin-favicon.png">
    <title>ADMINISTRATOR - ThanhPhan</title>
</head>
<body>
    <div class="container-fluid">
        <div class="header">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <div class="container">
                        <a class="navbar-brand" href="index.php">PHP Project 01</a>
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                            aria-expanded="false" aria-label="Toggle navigation"></button>

                        <div class="collapse navbar-collapse" id="collapsibleNavId">
                            <?php
                                require_once '../controller/c_menu.php';
                                $c_menu = new c_menu();
                                $c_menu->recurULMenu();
                            ?>
                            
                        </div>
                    </div>
                </nav>
                <!-- <div id="carouselId" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselId" data-slide-to="1"></li>
                        <li data-target="#carouselId" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="https://www.w3schools.com/bootstrap/la.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img src="https://www.w3schools.com/bootstrap/chicago.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img src="https://www.w3schools.com/bootstrap/la.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div> -->
            </div> <!-- end header -->
    </div> <!-- end container -->