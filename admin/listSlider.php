<?php require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_slider.php';

?>
    <div class="row">
        <div class="col-sm-12">
            <div class="listVideo text-left">
                <h3>List Slider</h3>
                <table class="table table-hover table-responsive-xl">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $c_slider = new C_slider();
                                $listSlider = $c_slider->getAllSlider();
                                foreach($listSlider as $key => $value)
                                {
                            ?>
                            <tr>
                                <td><?php echo $value['id'] ?></td>
                                <td><?php echo $value['title'] ?></td>
                                <td><img  style="width: 100px; height: 50px;" src="../public/fileUpload/<?php echo $value['imageSlider']?>" alt="slider image" ></td>
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
                                <td class="text-center"><a href="./editSlider.php?id=<?php echo $value['id']?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                <td class="text-center"><a href="./deleteSlider.php?id=<?php echo $value['id']?>"><i class="fa fa-minus"></i></a> </td>
                            </tr>

                            <?php
                                }
                        ?>
                        
                    </tbody>
                </table>
                <a href="./addSlider.php" class="btn btn-success">Add Slider</a>
               
            </div>
        </div>
    </div>
<?php require_once './footer.php'; ?>
