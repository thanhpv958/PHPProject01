<?php 
    ob_start();
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_video.php';

?>
<div class="row ">
    <div class="col-sm-12">
        <div class="add-video">
        <?php
            require_once '../controller/c_user.php';
            if( isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) ) {
                $c_user = new C_user();
                if($c_user->userSignup($_POST['email'], $_POST['username'], $_POST['password'], $_POST['repassword'])) {
                    $_POST['email'] = "";
                    $_POST['username'] = "";
                 };                                                                        
            }
            ?>
                <h3>Add User</h3>
                <form class="form" id="formLogin" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="repassword">Repassword</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" required>
                    </div>
                    <div class="form-group">
                            <label style="display:block">Status</label>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" checked name="status" id="status" value="1">Show
                            </label>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="0">Hidden
                            </label>       
                    </div>
                    <button class="btn btn-success">Add New User</button>

                </form>
        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>