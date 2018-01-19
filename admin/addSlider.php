<?php 
    ob_start();
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_slider.php';

?>
  <div class="row ">
    <div class="col-md-12">
      <div class="add-slider">
        <?php
            
            if(isset($_POST['title']) && isset($_FILES['image']) && isset($_POST['link']) && isset($_POST['ordernum']) && isset($_POST['status']) ) {
                $title = $_POST['title'];
                $image = $_FILES['image'];
                $link = $_POST['link'];
                $ordernum = $_POST['ordernum'];
                $status = $_POST['status'];

                $c_slider = new C_slider();
                $c_slider->addSlider($title, $image,  $link, $ordernum, $status);
                ob_end_flush();
            }   
        ?>
        <h3>Add Slider</h3>        
        <form method="POST" enctype="multipart/form-data" >
          <div class="form-group">
            <label for="title">Title</label>
            <input  type="text" class="form-control" id="title" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']?>" >   
          
          </div>

          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="<?php if(isset($_FILES['image']))  $_FILES['image']?>" > 
          </div>

          <div class="form-group">
            <label for="link">Link</label>
            <input type="text" class="form-control" id="link" name="link" value="<?php if(isset($_POST['link'])) echo $_POST['link']?>" > 
          </div>

          <div class="form-group">
            <label for="ordernum">Order number</label>
            <input type="number" class="form-control" id="ordernum" name="ordernum" value="<?php if(isset($_POST['ordernum'])) echo $_POST['ordernum']?>" > 
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
          
          <input type="submit" class="btn btn-primary" value="Add Slider">
        </form>
      </div>
    </div>
  </div>
<?php require_once './footer.php'; ?>