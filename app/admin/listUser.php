<?php require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_admin.php';

?>
    
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="listVideo text-left">
                <h3>List Slider</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>MD5 Password</th>
                            <th>Link</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $C_admin = new C_admin();
                                $listUser = $C_admin->getAllUser();
                                foreach($listUser as $value)
                                {
                            ?>
                            <tr>
                                <td><?php echo $value['id'] ?></td>
                                <td><?php echo $value['username'] ?></td>
                                <td><?php echo $value['password'] ?></td>
                                <td><?php echo $value['email'] ?></td>
                                <td class="text-center">
                                    <?php
                                        if($value['status'] == 1) {
                                            echo 'Active';
                                        } else {
                                            echo 'Deactive';
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><a href="./editSlider.php?id=<?php echo $value['id']?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                <td class="text-center"><a href="./deleteUser.php?id=<?php echo $value['id']?>"><i class="fa fa-minus"></i></a> </td>
                            </tr>

                            <?php
                                }
                        ?>
                        
                    </tbody>
                </table>
                <a href="./addSlider.php" class="btn btn-success">Add User</a>
               
            </div>
        </div>
    </div>
<?php require_once './footer.php'; ?>
