
$(function(){
    var endless_scroll_count = 0;
    var endless_in_loading = false;
    var endless_no_more_content = false;
    var endless_timer = 0;

    var $window = $(window);
    var $document = $(document);

    var post_config_name = $('.forum-title').attr('name');


    var url_server = base_url;
    var url_endless_endpoint = url_server + post_config_name + '/ajax/endless/';




    begin_endless_page();

    function begin_endless_page() {
        endless_listen_scroll(callback_scroll, 150, 250);
        endless_show_page_loader();
    }
    function endless_listen_scroll(callback, distance, interval) {
        var check_scroll_position = function() {
            if ( endless_in_loading ) return;
            var top = $document.height() - $window.height() - distance;
            if ($window.scrollTop() >= top) {
                endless_scroll_count ++;
                console.log("count:" + endless_scroll_count);
                callback(endless_scroll_count);
            }
        };
        endless_timer = setInterval(check_scroll_position, interval);
    }



    function callback_scroll(no) {
        if ( endless_no_more_content ) return;
        endless_in_loading = true;

        ajax_load( url_endless_endpoint + no, function(re) {
            console.log(re);
            if ( re.code ) {
                if ( re.code ==  -4 ) {
                    end_endless_page();
                    endless_hide_loader();
                    endless_show_no_more_content();
                }
                else alert("Unkown error");
            }
            else {

                console.log(re['html']);
                $(".post-list").append(re.html);
            }
            endless_in_loading = false;
        });
    }


    function endless_show_page_loader() {
        var src = url_server + 'widget/post_list_default/loader5.gif';
        $('.page').append("<div class='loader-endless-page'><img src='"+src+"'></div>")
    }

    function end_endless_page() {
        endless_no_more_content = true;
        clearInterval(endless_timer);
    }
    function endless_show_no_more_content() {
        var text = 'No more content!'
        $(".post-list").after("<div class='no-more-content'>"+text+"</div>");
    }

    function endless_hide_loader() {
        $('.loader-endless-page').remove();
    }
});