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
                        ob_start();
                        require_once './permission/config.php';
                        require_once '../controller/c_user.php';

                        $c_user = new C_user();
                        $user = $c_user->getUserByID($_SESSION['uid']);
                        $userRole = $user[0]['role'];
                        $roleData = explode(',', $userRole);
                      
                        foreach ($arrPermission as $per)
                        {
                            foreach ($roleData as $valueRoleData)
                            {
                                $valueRoleData = explode('|', $valueRoleData);

                                if($valueRoleData[0] == $per['title'])
                                {                           
                    ?>
                                    <li>
                                        <a href="<?php echo $per['linkTitle'];?>">
                                            <i class="fa fa-pencil"></i> <?php echo $per['title'];?></a>
                                        <ul class="sub-menu">
                                            <?php
                                                if($per['titleC1'] != '0' && $per['titleC2'] != '0' )
                                                {
                                            ?>
                                                    <li>
                                                        <a href="<?php echo $per['link_list1'] ?>"><i class="fa fa-star-half"></i> <?php echo $per['titleC1'] ?></a>
                                                    </li>
                                     
                                                <?php
                                                    if($per['link_list2'] != '0') {
                                                ?>

                                                    <li>
                                                        <a href="<?php echo $per['link_list2'] ?>"><i class="fa fa-star-half"></i> <?php echo $per['titleC2'] ?></a>
                                                    </li> 

                                                <?php
                                                    } else {
                                                ?>

                                                    <li>
                                                        <a href="<?php echo $per['link_add'] ?>"><i class="fa fa-star-half"></i> <?php echo $per['titleC2'] ?></a>
                                                    </li> 
                                                    
                                                <?php      
                                                    }
                                                ?> 
                                            <?php
                                                }
                                            ?>       
                                        </ul>
                                    </li>
                    <?php
                                }
                            }
                        }
                       
                        $current_url = $_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI'];
                        $current_url = explode('/', $current_url);
                        $countCurrentUrl = count($current_url);
                        $countURL = 1;
                        $okURL = 0;
                        
                        foreach ($current_url as $valueURl) {

                            if($countURL == $countCurrentUrl) {
                               
                                foreach ($roleData as $valueRoleData) {
                                    
                                    $valueRoleData = explode('|', $valueRoleData);
                                    
                                    if(isset($_GET['id']) ) {
                                        $valueURlEx = explode('?', $valueURl);
                                        if($valueRoleData[6] == $valueURlEx[0] || $valueRoleData[7] == $valueURlEx[0]) {
                                            $okURL = 1;
                                            break;
                                        }
                                    } else if(isset($_GET['page'])) {
                                        $valueURlEx = explode('?', $valueURl);
                                        if($valueRoleData[4] == $valueURlEx[0]) {
                                            $okURL = 1;
                                            break;
                                        }
                                    } else {
                                        if($valueRoleData[4] == $valueURl || $valueRoleData[5] == $valueURl) {   
                                            $okURL = 1;
                                            break;
                                        }
                                    }        
                                }

                                if($okURL != 1) {
                                    if($valueURl != 'index.php') {
                                        header('location: index.php');
                                    }
                                }
                            }
                            $countURL++;
                        }
                        ob_end_flush();             
                    ?>
                   
                </ul>
            </div>
            <!-- end sidebar -->
        </div>
        <!-- end col -->

        <div class="col-sm-10">
      