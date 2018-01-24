<?php 
    ob_start();
    require_once './header.php';
    require_once './sidebar.php'; 
    require_once '../controller/c_menu.php'; 
    require_once '../controller/c_article.php';
?>
  <div class="row ">
    <div class="col-sm-12">
      <div class="edit-video">
            <?php
                $id = isset($_GET['id']) ? $_GET['id'] : header('location: ./listArticle.php');
                $c_article = new C_article();
                if(isset($_POST['title']) &&  isset($_POST['bodyArticle']) && isset($_POST['category']) && isset($_POST['image']) && isset($_FILES['imageEdit']) && isset($_POST['status']) ) {
                    $title = $_POST['title'];
                    $body = $_POST['bodyArticle'];
                    $category = $_POST['category'];
                    $image = $_POST['image'];
                    $imageEdit = $_FILES['imageEdit'];
                    $status = $_POST['status'];
                    $c_article->editArticle($id, $title, $body, $category, $image, $imageEdit, $status);
                }   
                $article = $c_article->getArticleByID($id); 
                foreach($article as $key => $value)
                {          
            ?>
                    <h3>Edit Video: <?php echo $value['title'] ?></h3>

                    <form method="POST" enctype="multipart/form-data">  
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($value['title'])) echo $value['title'] ?>">  
                        </div>

                        <div class="form-group">
                            <label for="link">Body</label>
                            <textarea name="bodyArticle" id="bodyArticle" rows="10" cols="80">
                                <?php if(isset($value['body'])) echo $value['body']; ?>
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label  style="display:block;" for="category">Category: </label>
                            <?php
                                $c_menu = new c_menu();
                                echo "<select name='category'>";
                                    $c_menu->recurSelectMenuArticle($value['category']);
                                echo "</select>"
                            ?>
                            
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <img style="width: 100px; height: 50px;display:block" src="../public/fileUpload/<?php if(isset($value['image'])) echo $value['image'] ?>">
                            <input type="hidden" class="form-control" id="image" name="image" value="<?php if(isset($value['image'])) echo $value['image'] ?>">
                            <input type="file" class="form-control" id="imageEdit" name="imageEdit"> 
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
          <input type="submit" class="btn btn-primary" value="Save Video">
        </form>
      </div>
    </div>
  </div>
  <script src="../lib/ckeditor/ckeditor.js"></script>
<script src="../lib/ckfinder/ckfinder.js"></script>
<?php require_once './footer.php'; ?>