<?php
require_once './header.php';
require_once '../controller/c_article.php';

?>
    <div class="container">
        <div class="row">
            <?php
                $page = isset($_GET['id']) ? $_GET['id'] : 1;
                $c_article = new C_article();
                $c_article->configPagination($page, 'index');
                $listArticle  = $c_article->getAllArticleP();
                foreach($listArticle as $key => $article)
                {
            ?>
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="../public/fileUpload/<?php echo $article['image'] ?>" alt="">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $article['title']?> </h5>
                            <p class="card-text">
                                <?php
                                    $stripBody = strip_tags($article['body']);
                                    echo $c_article->subString($stripBody,0, 250);
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