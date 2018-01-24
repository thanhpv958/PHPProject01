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
                        foreach ($arrPermission as $key => $value) {
                       
                    ?>
                        <li>
                            <a href="<?php echo $value['linkTitle'];?>">
                                <i class="fa fa-pencil"></i> <?php echo $value['title'];?></a>
                            <ul class="sub-menu">
                                <?php
                                    if($value['titleC1'] != '0' && $value['titleC2'] != '0')
                                    {
                                ?>
                                        <li>
                                            <a href="<?php echo $value['link_list'] ?>"><?php echo $value['titleC1'] ?></a>
                                        </li>
                                        
                                        <li>
                                            <a href="<?php echo $value['link_add'] ?>"><?php echo $value['titleC2'] ?></a>
                                        </li>  
                                <?php
                                    }
                                ?>
                                
                            </ul>
                        </li>
                    <?php
                         }
                    ?>
                   
                </ul>
            </div>
            <!-- end sidebar -->
        </div>
        <!-- end col -->

        <div class="col-sm-10">
      