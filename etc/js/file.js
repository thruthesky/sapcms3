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



    var lastAction = $this.prop('action');
    $this.prop('action', '/data/ajax/upload');


    $this.ajaxSubmit({
        beforeSend: function () {
            console.log("bseforeSend:");
            showAjaxUploadProgressBar();
        },
        uploadProgress: function (event, position, total, percentComplete) {
            //console.log("while uploadProgress:" + percentComplete + '%');
            setAjaxUploadProgressBar(percentComplete + '%');
        },
        success: function () {
            console.log("upload success:");
            setAjaxUploadProgressBar('100%');
            setTimeout(function () {
                hideAjaxUploadProgressBar();
            }, 150);
        },
        complete: function (xhr) {
            console.log("Upload completed!!");
            var re;
            try {
                re = JSON.parse(xhr.responseText);
            }
            catch (e) {
                return alert(xhr.responseText);
            }

            console.log(re);

            if ( typeof callback_ajax_upload == 'function' ) callback_ajax_upload($this, re);
        }
    });

    return false;

    function showAjaxUploadProgressBar() {
        $progressBar.find('.progress-bar')
            .width(0);
        $progressBar.show();
    }
    function hideAjaxUploadProgressBar() {
        $progressBar.hide();
    }
    function setAjaxUploadProgressBar(percent) {
        $progressBar.find('.progress-bar')
            .text(percent)
            .width(percent);
    }

    function setFid(re) {
        var $data_id = $this.find("[name='data_id']");
        var val = $data_id.val();
        val += ','+ re['record'].id;
        $data_id.val(val);
    }
}