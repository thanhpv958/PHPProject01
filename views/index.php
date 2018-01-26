<?php
require_once './header.php';
require_once '../controller/c_article.php';
require_once '../controller/c_process.php';

?>
    <div class="container">
        <div class="row">
            <?php
                $page = isset($_GET['id']) ? $_GET['id'] : 1;
                $c_article = new C_article();
                $c_process = new C_process();
                $c_article->configPagination($page, 'index');
                $listArticle  = $c_article->getAllArticleP();
                
                foreach($listArticle as $article)
                {
                    // slug url
                    $articleTitleSlug = $c_process->toSlug($article['title']);
                   
            ?>
                <div class="col-sm-4">
                    <div class="card">
                        <a class="nounderline" href="<?php echo $article['id']?>--<?php echo $articleTitleSlug; ?>.html">
                            <img class="card-img-top" src="../public/fileUpload/<?php echo $article['image'] ?>" alt="">
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $article['title']?> </h5>
                        </a>
                                <p class="card-text">
                                    <?php
                                        $stripBody = strip_tags($article['body']);
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
    </div>   
<?php require_once './footer.php'; ?>