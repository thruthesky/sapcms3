function ajax_load($input, $callback) {

    if ( typeof $input == 'string' ) {
        console.log($input);
    }
    else {
        console.log($input.url);
    }

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
