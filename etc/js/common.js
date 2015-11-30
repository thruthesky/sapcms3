function ajax_load($input, $callback) {
    var request = $.ajax($input);
    request.done(function( data ) {
        //console.log(data);
        var re = $.parseJSON(data);
        if ( typeof $callback == 'function' ) $callback(re);
    });
    request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
    });
}
