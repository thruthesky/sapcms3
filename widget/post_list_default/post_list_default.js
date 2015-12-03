var isUploadSubmit = false;
var $fileSelected = null;
var post_config_name;

function post_list() {
    return $(".post-list");
}
function post(id) {
    return $(".post[no='"+id+"']");
}
function onFileChange(obj) {
    $fileSelected = $(obj);
    var $form = $fileSelected.parents("form");
    isUploadSubmit = true;
    $form.submit();
    isUploadSubmit = false;
    $fileSelected.val('');
}
$(function(){
    post_config_name = $('.forum-title').attr('name');
    var $body = $("body");
    $body.on('submit', '.ajax-upload', post_form_submit);
    $body.on('click', '.file[no] .delete', ajax_delete);
    $body.on('click', '.post-menu .edit', click_post_edit);
    $body.on('click', '.post-edit .cancel', click_post_edit_cancel);
    $body.on('click', '.post-menu .delete', click_post_delete);
    $body.on('click', '.post-menu .reply', click_post_reply);
    $body.on('click', '.post-menu .like', click_post_like);
});

/**
 *
 * @returns {boolean}
 */
function post_form_submit() {
    // Return if the form submit is not for ajax file upload.
    if (isUploadSubmit == false) {
        ajax_form_submit($(this));
    }
    else {
        ajax_file_upload($(this));
    }
    return false;
}

function ajax_form_submit($this) {
    console.log("ajax_form_submit() begin");
    ajax_load({
        'url': $this.prop('action'),
        'data': $this.serialize()
    }, function(re) {
        console.log("ajax_form_submit() ajax return :");
        var $post = post(re.id);
        if ( $post.length ) {
            $post.replaceWith(re.html);
        }
        else {
            var $parent = post(re['id_parent']);
            if ( $parent.length ) {
                $parent.find('.post-edit').remove();
                $parent.after(re.html);
            }
            else {
                post_list().prepend(re.html);
                form_clear($this);
            }
        }
    });
}

function  ajax_file_upload($this) {

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

            //console.log(re);

            if ( typeof callback_ajax_upload == 'function' ) callback_ajax_upload($this, re);
        }
    });

    $this.prop('action', lastAction);
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
}
function ajax_delete() {
    var no = $(this).parent().attr('no');
    ajax_load('/data/ajax/delete/' + no, callback_ajax_delete);
}

function form_clear($form) {
    var $post_edit = $form.parents('.post-edit');
    $form.find("[name='data_id']").val('');
    $form.find("[name='subject']").val('');
    $form.find("[name='content']").val('');
    $post_edit.find(".files").html('');
}

function get_post_edit_form(name, id, id_parent) {
    var m = '';
    m += '<div class="post-edit clearfix">';
    m += '<form class="ajax-upload clearfix" action="/'+name+'/edit/ajax/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';
    m += '<input type="hidden" name="id" value="'+id+'">';
    m += '<input type="hidden" name="id_parent" value="'+id_parent+'">';
    m += '<input type="hidden" name="data_id" value="">';
    m += '<input type="hidden" name="model" value="post">';
    m += '<input type="hidden" name="category" value="upload">';
    //m += '<div class="subject"><input type="text" name="subject" value=""></div>';
    m += '<div class="content"><textarea name="content"></textarea></div>';
    m += '<div class="file"><input type="file" name="file" onchange="onFileChange(this);"></div>';
    m += '<div class="submit"><input type="submit"></div>';
    if ( id || id_parent ) m += '<div class="cancel">[Cancel]</div>';
    m += '</form>';
    m += '<div class="files"></div>';
    m += '</div>';
    return m;
}


function click_post_reply() {
    var $this = $(this);
    var $post = $this.parents('.post');
    var id = $post.attr('no');
    var m = get_post_edit_form(post_config_name, 0, id);
    $post.append( m );
}
function click_post_edit() {
    var $this = $(this);
    var $post = $this.parents('.post');

    //var $subject  = $post.find(".subject");
    //var subject = '';

    // if ( $subject.length ) subject = $subject.text();

    var $content  = $post.find(".content");
    var content = '';
    if ( $content.length ) content = $content.text();
    var id = $post.attr('no');
    var id_parent = $post.attr('no-parent');


    var form = get_post_edit_form(post_config_name, id, id_parent);

    $post.find('.form-area').hide();
    $post.append(form);

    //$post.find("[name='subject']").val(subject);
    $post.find("[name='content']").val(content);

    var $files = $post.find(".files");

    if ( $files.length ) {
        var m = '';
        var $file = $files.find('.file');
        if ( $file.length ) {
            $file.each(function(i, element){
                $obj = $(element);
                var id = $obj.attr('no');
                var url = $obj.find('img').prop('src');
                console.log(url);
                m += get_display_file(url, id, true);
            });
            $files.html(m);
        }
    }
}

function click_post_edit_cancel() {
    var $this = $(this);
    var $post = $this.parents('.post');
    $post.find('.post-edit').remove();
    $post.find('.form-area').show();
}


/**
 * Use this function only to display uploaded files.
 *
 */
function get_display_file(url, id, edit) {
    var m = "<div class='file' no='"+id+"'>";
    if ( edit ) m += "<span class='delete'>X</span>";
    m += "<img src='"+url+"'></div>";
    return m;
}



function click_post_delete() {
    var $this = $(this);
    var $post = $this.parents('.post');
    var url = '/post/ajax/delete/' + $post.attr('no');
    ajax_load(url, function(re) {
        console.log(re);
        $post.find('.content').html(re.html);
        $post.find('.author').remove();
        $post.find('.files').remove();
    });
}

function click_post_like() {
    var $this = $(this);
    var $post = $this.parents('.post');
    var url = '/post/ajax/like/' + $post.attr('no');
    ajax_load(url, function(re) {
        //console.log(re);
        $this.find(".no").text(re.like);
    });
}