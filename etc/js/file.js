var isUploadSubmit = false;
var $fileSelected = null;
function onFileChange(obj) {
    $fileSelected = $(obj);
    var $form = $fileSelected.parents("form");
    isUploadSubmit = true;
    $form.submit();
    isUploadSubmit = false;
    $fileSelected.val('');
}


$(function(){
    $("body").on('submit', '.ajax-upload', ajax_upload);
});

/**
 *
 * @returns {boolean}
 */
function ajax_upload() {

    // Return if the form submit is not for ajax file upload.
    if (isUploadSubmit == false) return true;

    var $this = $(this);

    console.log( $fileSelected.prop('name') );

    var $progressBar = $(".ajax-upload-progress-bar");


    /**
     *
    var lastAction = $this.prop('action');
    $this.prop('action', '/file/upload');

    $this.ajaxSubmit({
        beforeSend: function () {
            console.log("bseforeSend:");
            showProgressBar();
        },
        uploadProgress: function (event, position, total, percentComplete) {
            //console.log("while uploadProgress:" + percentComplete + '%');
            setProgressBar(percentComplete + '%');
        },
        success: function () {
            console.log("upload success:");
            setProgressBar('100%');
            setTimeout(function () {
                hideProgressBar();
            }, 150);
        },
        complete: function (xhr) {
            console.log("Upload completed!!");
            var re;
            try {
                re = JSON.parse(xhr.responseText);
                //alert errors...
                if (re.error) return alert(re.message);
            }
            catch (e) {
                return alert(xhr.responseText);
            }

            console.log(re);

            fileDisplay($this, re);
            fileCallback(re);
            setFid(re);
        }
    });
    */
}
