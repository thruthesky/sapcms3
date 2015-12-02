function post_comment_form(id) {
    var m = '<div class="post-comment-form clearfix">';
    m += '<form class="ajax-upload" action="/post/comment/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';
    m += '<input type="hidden" name="id_parent" value="'+id+'">';
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










