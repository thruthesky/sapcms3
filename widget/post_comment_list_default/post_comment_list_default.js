$(function(){
    $(".post-comment-list .row .reply").click(function(){
        var $parent = $(this).parents(".row");
        var no = $parent.attr('no');
        $parent.append( post_comment_form( no ));
    });

    $('body').on('click', ".post-comment-list .row .menu .edit", editComment);

});
function editComment() {
    var $this = $(this);
    var $row = $this.parents('.row');
    var $content = $row.find(".content");
    var content = $content.text();
    var id = $row.attr('no');
    var form = post_comment_edit_form(id);
    $content.html(form);

    $content.find("[name='content']").val(content);
}
function post_comment_edit_form(id) {
    var m = '<div class="post-comment-edit-form clearfix">';
    m += '<form class="ajax-upload" action="/post/comment/edit/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';
    m += '<input type="hidden" name="id" value="'+id+'">';
    m += '<input type="hidden" name="data_id" value="">';
    m += '<input type="hidden" name="model" value="post">';
    m += '<input type="hidden" name="category" value="upload">';
    m += '<div class="content"><textarea name="content" placeholder="Input comment..."></textarea></div>';
    m += '<div class="file"><input type="file" name="file" onchange="onFileChange(this);"></div>';
    m += '<div class="submit"><input type="submit"></div>';
    m += '<div class="files"></div>';
    m += '</form>';
    m += '</div>';
    return m;
}
