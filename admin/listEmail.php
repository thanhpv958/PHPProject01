<?php require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_email.php';

?>
    <div class="row">
        <div class="col-sm-12">
            <div class="listVideo ">
                <h3>List Email</h3>
                <table class="table table-hover text-left table-responsive-xl">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Send From</th>
                            <th>Send To</th>
                            <th>Subject</th>
                            <th>Time</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $c_email = new C_email();
                                $c_email->configPagination($page, 'listEmail');
                                $listEmail = $c_email->getAllEmailP();
                                foreach($listEmail as $key => $email)
                                {
                            ?>
                            <tr>
                                <td><?php echo $email['id'] ?></td>
                                <td class="text-left"><?php echo $email['user_id'] ?></td>
                                <td> <?php echo $email['sendto'] ?> </td>
                                <td><?php echo $email['subject'] ?></td>
                                <td><?php echo $email['time'] ?></td>
                                <td class="text-center"><a href="./deleteArticle.php?id=<?php echo $email['id']?>"><i class="fa fa-minus"></i></a> </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div class="abc">
                    <?php
                        echo $c_email->showPagination();
                    ?>
                </div>
                <a href="./addEmail.php" class="btn btn-success text-left">New Email</a>
               
            </div>
        </div>
    </div>
<?php require_once './footer.php'; ?>
