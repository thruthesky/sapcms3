var is_animating = false;

$(function () {
	$("body").on( "click",".message-list .list-group-item", openMessageContent );
	$("body").on( "click",".message-list .list-group-item .delete", deleteMessage );
});

function openMessageContent( e ){
	if( $(e.target).hasClass('delete') ) return;
	if( $(e.target).hasClass('reply') ) return;
	if( $(e.target).hasClass('message-content') ) return;
	if( $(e.target).parent().hasClass('.message-content') ) return;
	if( $(e.target).parents('.message-content').length ) return;
	if( is_animating == true ) return;
	
	is_animating = true;
	
	var $row = $(this);
	var no = $row.attr('no');
	var type = $row.parent().attr('type');
	
	var request = $.ajax({
		url: "/message/ajax/load",
		data: { id : no, type : type }
	});

	request.done(function( data ) {
		re = JSON.parse(data);
		if( !re.error ){
			if( $row.find(".message-content").length ){
				$row.find(".message-content").slideToggle("500",callbackAnimateSlide);
			}
			else{
				if( re.checked ){
					if( $row.find( '.checked' ).length ){
						$row.find( '.checked' ).html( re.checked );
						$row.addClass('viewed');
					}
				}				
				$row.append( $(re.content) );
				$row.find(".message-content").slideDown("500",callbackAnimateSlide);
			}
		}
	});

	request.fail(function( jqXHR, textStatus ) {		
		alert( "Request failed: " + textStatus );
		is_animating = false;
	});
}

function deleteMessage(){
	re = confirm("Are you sure you want to delete this message?");
	if( !re ) return;
	
	var $row = $(this).parents(".list-group-item");
	var no = $row.attr('no');
	
	var last_no = $(".message-list .list-group-item:last").attr('no');
	
	var type = $row.parent().attr('type');	
	
	var request = $.ajax({
		url: "/message/ajax/delete",
		data: { id : no, last_id : last_no, type : type }
	});
	
	request.done(function( data ) {
		re = JSON.parse(data);
		if( !re.error ){
			console.log( re );
			if( re.id ){
				$row.remove();
			}			
			if( re.next_message ){
				$(".message-list").append( $(re.next_message) );
			}
		}
	});

	request.fail(function( jqXHR, textStatus ) {
		alert( "Request failed: " + textStatus );
	});
}

function callbackAnimateSlide(){
	is_animating = false;
}




/*modal image*/

$(function () {
	$("body").on( "click",".modal-image", modalImage );
	$("body").on( "click",".modal_window", removeModalWindow );
	
	$(window).resize(function(){
		if( $(".modal_window").length ) doImageAdjust();
	});
});

function modalImage(){
	if( !$(".modal_window").length ) $("body").append( createModalWindow() );

	var $this = $(this);
	var id = $this.attr('no');
	
	if( $(".modal_window .modalImageWrapper[no='"+id+"']").length ){
		$(".modal_window .modalImageWrapper.is-active").removeClass('is-active');
		$(".modal_window .modalImageWrapper[no='"+id+"']").addClass('is-active');
	}
	else{
		var data = {};
		data.url = 'http://sapcms3.org/message/ajax/imageModalWindow?id='+id;
		ajax_load(data, function(data) {
			console.log(data);
			$(".modal_window .modalImageWrapper.is-active").removeClass('is-active');
			$(".modal_window").append(data.html);
			
			$(".modal_window .modalImageWrapper[no='"+data.current_file+"'] img").load(function(){				
				$(".modal_window .modalImageWrapper[no='"+data.current_file+"']").addClass('is-active');
				doImageAdjust();
			});
			
		});
	}
}

function createModalWindow(){
	return "<div class='modal_window' style='position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.6);z-index:9999;text-align:center'></div>";
}

function removeModalWindow( e ){
	if( $( e.target ).hasClass('modal_window') ) $(".modal_window").remove();
	if( $( e.target ).hasClass('modalImageWrapper') ) $(".modal_window").remove();
}

function doImageAdjust(){	
	var $selector = $('.modal_window .modalImageWrapper.is-active img');
	var window_width = $(window).width();
	var window_height = $(window).height();
	
	console.log( $selector.length );
	if( $selector.height() >= $selector.width() ) {				
		$selector.css('width','initial').css('height',$(window).height());			
		if( $selector.width() > $(window).width() ) $selector.css('max-width','100%').css('height','initial');		
	}
	if( $selector.width() >= $selector.height() ){
		$selector.css('height','initial').css('max-width','100%');
		if( $selector.height() > $(window).height() ) $selector.css('height', ( $(window).height() ) ).css('width','initial');		
	}
	
	var margin_top = window_height/2 - $selector.height()/2;

	if( margin_top < 0 ) margin_top = 0;
	$selector.parent().css('margin-top',margin_top);//compatible for $(".modal_widow > .modal_image > img")
	
	$selector.show();
}