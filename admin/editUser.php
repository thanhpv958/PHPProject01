<?php 
    ob_start();
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_user.php';
?>
  <div class="row ">
    <div class="col-md-12">
      <div class="edit-video">
            <?php
                $id = $_GET['id'];
                $c_user = new C_user();
                // if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['status']) ) {
                //     $title = $_POST['email'];
                //     $link = $_POST['username'];
                //     $password = $_POST['password'];
                //     $status = $_POST['status'];
                //     $c_video->editVideo($id, $title, $link, $status);
                //     ob_end_flush();
                // }   
                $user = $c_user->getUserByID($id); 
                foreach($user as $key => $value)
                {          
            ?>
                    <h3>Edit User: <?php echo $value['username'] ?></h3>

                    <form method="POST">  
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($value['email'])) echo $value['email'] ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" value="<?php if(isset($value['username'])) echo $value['username'] ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="<?php if(isset($value['password'])) echo $value['password'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label style="display:block">Status</label>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" <?php if($value['status'] == 1) echo 'checked' ?> name="status" id="status" value="1">Show
                            </label>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" <?php if($value['status'] == 0) echo 'checked' ?> name="status" id="status" value="0">Hidden
                            </label>       
                        </div>
            <?php
                }
            ?>
          <input type="submit" class="btn btn-primary" value="Save Video">
        </form>
      </div>
    </div>
  </div>
<?php require_once './footer.php'; ?>