<?php require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_article.php';

?>
    <div class="row">
        <div class="col-md-12">
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
                                $c_article->configPagination($page);
                                $listArticle = $c_article->getAllArticleP();
                                foreach($listArticle as $key => $value)
                                {
                            ?>
                            <tr>
                                <td><?php echo $value['id'] ?></td>
                                <td class="text-left"><?php echo $value['title'] ?></td>
                                <td><?php echo $value['category'] ?></td>
                                <td><img  style="width: 100px; height: 50px;" src="../../public/fileUpload/<?php echo $value['image']?>" alt="slider image" ></td>
                                <td><?php echo $value['time'] ?></td>
                                <td><?php echo $value['view'] ?></td>
                                <td class="text-center">
                                    <?php
                                        if($value['status'] == 1) {
                                            echo 'Show';
                                        } else {
                                            echo 'Hidden';
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><a href="./editSlider.php?id=<?php echo $value['id']?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                <td class="text-center"><a href="./deleteSlider.php?id=<?php echo $value['id']?>"><i class="fa fa-minus"></i></a> </td>
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
