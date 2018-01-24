<?php require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_article.php';

?>
    <div class="row">
        <div class="col-sm-12">
            <div class="listVideo ">
                <h3>List Article</h3>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Time</th>
                            <th>View</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $c_article = new C_article();
                                $c_article->configPagination($page, 'listArticle');
                                $listArticle = $c_article->getAllArticleP();
                                foreach($listArticle as $key => $article)
                                {
                            ?>
                            <tr>
                                <td><?php echo $article['id'] ?></td>
                                <td class="text-left"><?php echo $article['title'] ?></td>
                                <td>
                                    <?php 
                                        echo $c_article->showNameCategory($article['category']);  
                                    ?>
                                </td>
                                <td><img  style="width: 100px; height: 50px;" src="../public/fileUpload/<?php echo $article['image']?>" alt="slider image" ></td>
                                <td><?php echo $article['time'] ?></td>
                                <td><?php echo $article['view'] ?></td>
                                <td class="text-center">
                                    <?php
                                        if($article['status'] == 1) {
                                            echo 'Show';
                                        } else {
                                            echo 'Hidden';
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><a href="./editArticle.php?id=<?php echo $article['id']?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                <td class="text-center"><a href="./deleteArticle.php?id=<?php echo $article['id']?>"><i class="fa fa-minus"></i></a> </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div class="abc">
                    <?php
                        echo $c_article->showPagination();
                    ?>
                </div>
                <a href="./addArticle.php" class="btn btn-success text-left">Add New Article</a>
               
            </div>
        </div>
    </div>
<?php require_once './footer.php'; ?>
