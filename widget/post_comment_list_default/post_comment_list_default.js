$(function(){
    $(".post-comment-list .row .reply").click(function(){
        var $parent = $(this).parent();
        $parent.append( comment_form( $parent.attr('no') ));
    });


    function comment_form(id_parent) {
        var m = "<form class='post-comment-form' action='/post/comment/submit' method='post'>";
        m += "<input type='hidden' name='id_parent' value='"+id_parent+"'>";
        m += "<textarea name='content' placeholder='Input comment...'></textarea>";
        m += "<input type='submit'>";
        m += "</form>";
        return m;
    }

});