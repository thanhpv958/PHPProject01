<?php
    require_once './header.php';
    require_once './sidebar.php';
    require_once '../controller/c_article.php'; 
?>

  <div class="row ">
    <div class="col-sm-12">
      <div class="add-video">
        <?php
            if(isset($_POST['title']) && isset($_POST['bodyArticle']) && isset($_POST['category']) && isset($_FILES['image']) && isset($_POST['time']) && isset($_POST['status']) ) {
                $title = $_POST['title'];
                $body = $_POST['bodyArticle'];
                $category = $_POST['category'];
                $image = $_FILES['image'];
                $time = $_POST['time'];
                $status = $_POST['status'];
                $c_article = new C_article();
                $c_article->addArticle($title, $body, $category, $image, $time, $status);
            }         
        ?>
        <h3>Add Article</h3>        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input  type="text" class="form-control" id="title" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']?>" >   
            
            </div>

            <div class="form-group">
                <label for="bodyArticle">Body</label>
                <textarea type="text" class="form-control" id="bodyArticle" name="bodyArticle" ></textarea>

            </div>

            <div class="form-group">
                <label style="display:block;" for="category">Category</label>
                <?php
                    require_once '../controller/c_menu.php';
                    $c_menu = new c_menu();
                    echo "<select name='category'>";
                    $c_menu->recurSelectMenu();
                    echo "</select>"
                ?>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" >           
            </div>

            

            <div class="form-group">
                <!-- <label for="ordernum">Time</label> -->
                <input type="hidden" class="form-control" id="time" name="time" value="<?php echo date('Y/m/d h:i A'); ?>"  > 
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
            
            <input type="submit" class="btn btn-primary" value="Add Video">
        </form>
      </div>
    </div>
  </div>

<script src="../lib/ckeditor/ckeditor.js"></script>
<script src="../lib/ckfinder/ckfinder.js"></script>
<script>
    $(function() {
    //CKEDITOR.replace('bodyArticle');
        CKEDITOR.replace( 'bodyArticle',
        {
            filebrowserBrowseUrl: '../lib/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '../lib/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });

    })
</script>
<?php require_once './footer.php' ?>