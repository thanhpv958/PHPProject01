<?php
    $catID = $_GET['cat'];
    if( filter_var($catID, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) == false) {
        header('location: index.php');
    } else {
        require_once './header.php';
        require_once '../controller/c_article.php';
        require_once '../controller/c_process.php';
?>
    <div class="container">
            <div class="row">
                <?php
                    $c_article = new C_article();
                    $c_process = new C_process();
                    $c_article->configPagination(1, 'articleCat');
                    $listArticle  = $c_article->getArticleByCat($catID);
                    foreach($listArticle as $article)
                    {
                        $articleTitleSlug = $c_process->toSlug($article['title']);
                ?>
                    <div class="col-sm-4">
                        <div class="card">
                            <a class="nounderline" href="<?php echo $article['id']?>--<?php echo $articleTitleSlug; ?>.html">
                                <img class="card-img-top"  src="../public/fileUpload/<?php echo $article['image'] ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php echo $article['title']?> </h5>
                            </a>
                                    <p class="card-text">
                                        <?php
                                            $stripBody = strip_tags($article['body']);
                                            $c_process = new C_process();
                                            echo $c_process->subString($stripBody,0, 250);
                                        ?>
                                    </p>
                                </div>             
                        </div>
                    </div>
                <?php
                    }  
                ?>
            </div>
            <?php
                echo $c_article->showPagination();
            ?>  
    </div>
<?php
    require_once './footer.php';
    }
?>
 
