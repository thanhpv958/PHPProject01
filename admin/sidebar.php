<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <!-- start sidebar -->
            <div class="sidebar">
                <ul class="menu">
                    <li>
                        <a href="index.php">
                            <i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <?php
                        require_once './permission/config.php';
                        require_once '../controller/c_user.php';
                        $c_user = new C_user();
                        $user = $c_user->getUserByID($_SESSION['uid']);
                        $userRole = $user[0]['role'];
                        $roleData = explode(',', $userRole);                     
                        foreach ($arrPermission as $per)
                        {
                            foreach ($roleData as  $valueRoleData)
                            {
                                $roleData1 = explode('|', $valueRoleData);  
                                if($roleData1[0] == $per['title'])
                                {                           
                    ?>
                                    <li>
                                        <a href="<?php echo $per['linkTitle'];?>">
                                            <i class="fa fa-pencil"></i> <?php echo $per['title'];?></a>
                                        <ul class="sub-menu">
                                            <?php
                                                if($per['titleC1'] != '0' && $per['titleC2'] != '0')
                                                {
                                            ?>
                                                    <li>
                                                        <a href="<?php echo $per['link_list'] ?>"><?php echo $per['titleC1'] ?></a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="<?php echo $per['link_add'] ?>"><?php echo $per['titleC2'] ?></a>
                                                    </li>  
                                            <?php
                                                }
                                            ?>
                                            
                                        </ul>
                                    </li>
                    <?php
                                }
                            }
                        }
                    ?>
                   
                </ul>
            </div>
            <!-- end sidebar -->
        </div>
        <!-- end col -->

        <div class="col-sm-10">
      