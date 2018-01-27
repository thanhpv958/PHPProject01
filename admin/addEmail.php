<?php
    ob_start();
    require_once './header.php';
    require_once './sidebar.php';
    require_once '../controller/c_email.php';

    if( isset($_POST['sendto']) && isset($_POST['subject']) && isset($_POST['bodyEmail']) && isset($_POST['time'])) {
        $sendTo = $_POST['sendto'];
        $subject = $_POST['subject'];
        $bodyEmail = $_POST['bodyEmail'];
        $time = $_POST['time'];
        $c_email = new C_email();
        $c_email->sendEmail($_SESSION['uid'], $sendTo, $subject, $bodyEmail, $time);
        ob_end_flush();
    }
?>

  <div class="row ">
    <div class="col-sm-12">
      <div class="add-video">
    
        <h3>Add Email</h3>        
        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Send To</label>
                <input  type="text" class="form-control" id="sendto" name="sendto" value="<?php if(isset($_POST['sendto'])) echo $_POST['sendto']?>" >    
            </div>

            <div class="form-group">
                <label for="title">Subject</label>
                <input  type="text" class="form-control" id="subject" name="subject" value="<?php if(isset($_POST['subject'])) echo $_POST['subject']?>" >    
            </div>

            <div class="form-group">
                <label for="bodyEmail">Body</label>
                <textarea  type="text" class="form-control" id="bodyEmail" name="bodyEmail" ></textarea>

            </div>

 
            <div class="form-group">
                <!-- <label for="ordernum">Time</label> -->
                <input type="hidden" class="form-control" id="time" name="time" value="<?php echo date('Y/m/d h:i A'); ?>"  > 
            </div>

            <input type="submit" class="btn btn-primary" value="Send mail">
        </form>
      </div>
    </div>
  </div>

<script src="../lib/ckeditor/ckeditor.js"></script>
<script src="../lib/ckfinder/ckfinder.js"></script>
<script>
    $(function() {
    //CKEDITOR.replace('bodyArticle');
        CKEDITOR.replace( 'bodyEmail',
        {
            filebrowserBrowseUrl: '../lib/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '../lib/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });

    })
</script>
<?php require_once './footer.php' ?>