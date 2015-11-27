$(function () {


    $(".message-list .row").click(function(){
        var $row = $(this);
        var no = $row.attr('no');

        var request = $.ajax({
            url: "/message/ajax/load",
            data: { id : no }
        });

        request.done(function( msg ) {
            console.log(msg);
        });

        request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });



    });
});