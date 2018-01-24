<?php 
    ob_start();
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once './permission/config.php'; 
    require_once '../controller/c_user.php';
?>
  <div class="row ">
    <div class="col-sm-12">
      <div class="edit-video">
            <?php
                $id = $_GET['id'];
                $c_user = new C_user();

                //edit user
                $role = isset($_POST['role']) ? $_POST['role'] : '';
                if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['status'])) {
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $status = $_POST['status'];
                    $c_user->editUser($id, $email, $username, $password, $role, $status);
                }
                //end edit user

                //get user by id to show view
                $user = $c_user->getUserByID($id); 
                foreach($user as $key => $valueUser)
                {          
            ?>
                    <h3>Edit User: <?php echo $valueUser['username'] ?></h3>

                    <form method="POST">  
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($valueUser['email'])) echo $valueUser['email'] ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control"  name="username" id="username" value="<?php if(isset($valueUser['username'])) echo $valueUser['username'] ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control"  name="password" id="password" value="<?php if(isset($valueUser['password'])) echo $valueUser['password'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label style="display:block">Role</label>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="checkbox" name="fullrole" id="fullrole"> <label>Full Role</label>
                                </div>
                             

                            <?php
                                $roleData = explode(',', $valueUser['role']);
                                foreach ($arrPermission as $per)
                                {
                                    
                                    $checkRole = 0;
                                    foreach ($roleData as  $valueRoleData) {
                                        $perArr = $per['title'].'|'.$per['linkTitle'].'|'.$per['titleC1'].'|'.$per['titleC2'].'|'.$per['link_list']
                                        .'|'.$per['link_add'].'|'.$per['link_edit'].'|'.$per['link_delete'];
                                        if($valueRoleData == $perArr) {
                                            $checkRole = 1;
                                            break;
                                        }
                                    }
                            ?>
                                    <div class="col-sm-4">
                                        <input type="checkbox" name=role[]  <?php if($checkRole==1) {?> checked='checked' <?php }?> value="<?php
                                            echo $per['title'].'|'.$per['linkTitle'].'|'.$per['titleC1'].'|'.$per['titleC2'].'|'.$per['link_list']
                                                .'|'.$per['link_add'].'|'.$per['link_edit'].'|'.$per['link_delete'];
                                    ?>">   
                                    <label> <?php echo $per['title'] ?> </label>
                                    </div>
                            <?php       
                                }
                            ?>
                                </div>
                            </div>

                        <div class="form-group">
                            <label style="display:block">Status</label>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" id="status1" <?php if($valueUser['status'] == 1) echo 'checked' ?> name="status" id="status" value="1">Show
                            </label>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" id="status0" <?php if($valueUser['status'] == 0) echo 'checked' ?> name="status" id="status" value="0">Hidden
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

<script>
    $(function() {
        $('#fullrole').change(function() {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        })
    })
</script>