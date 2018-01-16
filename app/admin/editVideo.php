<?php 
 
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_admin.php';
    
  

?>
  <div class="row ">
    <div class="col-md-12">
      <div class="edit-video">
            <?php
                $id = $_GET['id'];
                $C_admin = new C_admin();
                $video = $C_admin->getVideoByID($id);
               
                foreach($video as $key => $value)
                {          
            ?>
                    <h3>Edit Video: <?php echo $value['title'] ?></h3>

                    <?php if(isset($messageSuccess)) echo $messageSuccess ?>

                    <form method="POST">  
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($value['title'])) echo $value['title'] ?>">   
                            <?php if(isset($errors['title'])) echo $errors['title']; ?>
                        </div>

                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" value="<?php if(isset($value['link'])) echo $value['link'] ?>"> 
                            
                            <?php if(isset($errors['link'])) echo $errors['link']; ?>
                        </div>

                        <div class="form-group">
                            <label for="ordernum">Order number</label>
                            <input type="number" class="form-control" id="ordernum" name="ordernum" value="<?php if(isset($value['ordernum'])) echo $value['ordernum'] ?>">    
                            
                            <?php if(isset($errors['ordernum'])) echo $errors['ordernum']; ?> 
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
            <?php
                }
            ?>
          <input type="submit" class="btn btn-primary" value="Add Video">
        </form>
      </div>
    </div>
  </div>
<?php require_once './footer.php'; ?>