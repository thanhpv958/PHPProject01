$(function() {
    //CKEDITOR.replace('bodyArticle');
    CKEDITOR.replace( 'bodyArticle',
    {
        filebrowserBrowseUrl: '../../lib/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '../../lib/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '../../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '../../lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });

})