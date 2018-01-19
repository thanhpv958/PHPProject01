<?php 
    ob_start();
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_slider.php';
?>
  <div class="row ">
    <div class="col-md-12">
      <div class="edit-slider">
            <?php
                $id = $_GET['id'];
                
                //process
                if(isset($_POST['title']) && isset($_FILES['imageEdit']) && isset($_POST['link']) && isset($_POST['ordernum']) && isset($_POST['status']) ) {
                    $title = $_POST['title'];
                    $image = $_POST['image'];
                    $imageEdit = $_FILES['imageEdit'];
                    $link = $_POST['link'];
                    $ordernum = $_POST['ordernum'];
                    $status = $_POST['status'];

                    $c_slider = new C_slider();
                    $c_slider->editSlider($id, $title, $image, $imageEdit, $link, $ordernum, $status);
                    ob_end_flush();
                }   

                // get data
                $slider = $C_admin->getSliderByID($id);
               
                foreach($slider as $key => $value)
                {          
            ?>
                    <h3>Edit slider: <?php echo $value['title'] ?></h3>

                

                    <form method="POST" enctype="multipart/form-data">  
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($value['title'])) echo $value['title'] ?>">   
                            
                        </div>

                        <div class="form-group">
                            <label for="imageEdit">Image</label>
                            <img style="width: 100px; height: 50px;display:block" src="../../public/fileUpload/<?php if(isset($value['imageSlider'])) echo $value['imageSlider'] ?>" alt="">
                            <input type="hidden" class="form-control" id="image" name="image" value="<?php if(isset($value['imageSlider'])) echo $value['imageSlider'] ?>">     
                            <input type="file" class="form-control" id="imageEdit" name="imageEdit" >      
                        </div>
                        
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" value="<?php if(isset($value['link'])) echo $value['link'] ?>">        
                        </div>

                        <div class="form-group">
                            <label for="ordernum">Order number</label>
                            <input type="number" class="form-control" id="ordernum" name="ordernum" value="<?php if(isset($value['ordernum'])) echo $value['ordernum'] ?>">    
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