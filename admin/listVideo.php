<?php require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_video.php';
    require_once '../controller/c_pagination.php';

?>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="listVideo text-left">
                <h3>List Video</h3>
                <table class="table table-hover table-responsive-xl">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                               $page = isset($_GET['page']) ? $_GET['page'] : 1;
                               $c_video = new c_video();
                               $c_video->configPagination($page);
                               $listVideo = $c_video->getAllVideoP();

                                foreach($listVideo as $value)
                                {
                            ?>
                            <tr>
                                <td><?php echo $value['id'] ?></td>
                                <td><?php echo $value['title'] ?></td>
                                <td><?php echo $value['link'] ?></td>
                                <td class="text-center">
                                    <?php
                                        if($value['onstatus'] == 1) {
                                            echo 'Show';
                                        } else {
                                            echo 'Hidden';
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><a href="./editVideo.php?id=<?php echo $value['id']?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                <td class="text-center"><a href="./deleteVideo.php?id=<?php echo $value['id']?>"><i class="fa fa-minus"></i></a> </td>
                            </tr>

                            <?php
                                }
                        ?>
                        
                    </tbody>
                </table>
                <?php
                    
                    echo $c_video->showPagination();
                ?>
                <a href="./exportVideo.php" class="btn btn-success" >Export Excel</a>
            </div>
        </div>
    </div>
    
<?php require_once './footer.php'; ?>