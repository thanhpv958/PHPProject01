<?php
    $articleID = $_GET['id'];
    if( filter_var($articleID, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) == false ) {
        header('location: index.php');
    } else {
        require_once './header.php';
        require_once '../controller/c_article.php';
        $c_article = new C_article();
        $article = $c_article->getArticleByID($articleID);
        $articleCatName = $c_article->showNameCategory($article[0]['category']);
        
        // other article
        $otherArticle = $c_article->getRandArticle();
?>
 
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mt-sm-4">

                <!-- breadcrumb -->
                <div class="breadcrumbArticle">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="nounderline" href="index.php" title="Home"> <i class="fa fa-home"></i></a> </li>
                        <li class="breadcrumb-item"> <a class="nounderline" href="./articleCat.php?cat=<?php echo $article[0]['category']?>" title="<?php echo $articleCatName ?>"> <?php echo $articleCatName ?></a></li>
                        <li class="breadcrumb-item"> <a class="nounderline breadcrumb-item active"href="./article.php?id=<?php echo $article[0]['id']?>" title="<?php echo $article[0]['title'] ?>"><?php echo $article[0]['title'] ?></a> </li>
                    </ul>
                </div>
                <!-- end breadcrumb -->

                <!-- article -->
                <div class="article">
                    <div class="card mt-sm-4">
                        <div class="card-body">
                            <div class="timeArticle">
                                <p class="font-italic font-weight-light"> <i class="fa fa-clock-o"></i> <?php echo $article[0]['time']?></p>
                            </div>
                            <h3 class="card-title"> <?php echo $article[0]['title']?> </h3>
                            
                            <div class="card-text">
                                <?php echo $article[0]['body']?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end article -->
            </div> <!--end col -->

            <div class="col-sm-4 mt-sm-4">

                <!-- seach -->
                <div class="search">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-inline" action="">
                                <input class="form-control mr-sm-1" type="text" placeholder="Search">
                                <button class="btn btn-danger" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end seach -->

                 <!-- other post -->
                <div class="otherpost">
                    <div class="card mt-sm-5">
                        <div class="card-body">
                            <h4 class="mb-sm-4">OTHER POSTS</h4>
                            <?php
                                foreach($otherArticle as $value)
                                {
                            ?>
                                <p> <a class="nounderline" href="./article.php?id=<?php echo $value['id'] ?>"><?php echo $value['title']?></a> </p>
                            <?php
                                }
                            ?>  
                        </div>
                    </div>
                </div>
                <!-- end other article -->
            </div>
        </div>
    </div>
<?php
    require_once './footer.php';
    }
?>