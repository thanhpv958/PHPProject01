<?php require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_user.php';
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
                                $c_user = new c_user();
                                $listUser = $c_user->getAllUser();
                                foreach($listUser as $user)
                                {
                            ?>
                            <tr>
                                <td><?php echo $user['id'] ?></td>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['password'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td class="text-center">
                                    <?php
                                        if($user['status'] == 1) {
                                            echo 'Active';
                                        } else {
                                            echo 'Deactive';
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><a href="./editUser.php?id=<?php echo $user['id']?>"><i class="fa fa-pencil-square-o"></i></a> </td>
                                <td class="text-center"><a href="./deleteUser.php?id=<?php echo $user['id']?>"><i class="fa fa-minus"></i></a> </td>
                            </tr>

                            <?php
                                }
                        ?>
                    </tbody>
                </table>
                <a href="./addUser.php" class="btn btn-success">Add User</a>
               
            </div>
        </div>
    </div>
<?php require_once './footer.php'; ?>
