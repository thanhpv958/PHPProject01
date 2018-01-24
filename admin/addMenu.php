<?php 
    ob_start();
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_menu.php';

?>
  <div class="row ">
    <div class="col-sm-12">
      <div class="add-slider">
        <?php
           
            if(isset($_POST['title']) && isset($_POST['parent']) && isset($_POST['link'])  && isset($_POST['status']) ) {
                $title = $_POST['title'];
                $parent = $_POST['parent'];
                $link = $_POST['link'];
                $status = $_POST['status']; 
                $c_menu = new c_menu();
                $c_menu->addMenu($title, $parent, $link, $status);
            }   
        ?>
        <h3>Add Menu</h3>        
        <form method="POST" >
          <div class="form-group">
            <label for="title">Title</label>
            <input  type="text" class="form-control" id="title" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']?>" >   
          
          </div>

          <div class="form-group">
            <label style="display:block;" for="parentMenu">Parent Menu</label>
  
            <?php
              $c_menu = new c_menu();
              echo "<select name='parent'>";
              echo "<option value='0'>Select Parent Menu</option>";
              $c_menu->recurSelectMenu();
              echo "</select>"
            ?>
          </div>

          <div class="form-group">
            <label for="title">Link</label>
            <input  type="text" class="form-control" id="link" name="link" value="<?php if(isset($_POST['link'])) echo $_POST['link']?>" >   
          
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
          
          <input type="submit" class="btn btn-primary" value="Add Menu">
        </form>
      </div>
    </div>
  </div>
<?php require_once './footer.php'; ?>