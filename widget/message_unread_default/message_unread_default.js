var is_animating = false;

$(function () {
	$("body").on( "click",".message-list .list-group-item", openMessageContent );
	$("body").on( "click",".message-list .list-group-item .delete", deleteMessage );
});

function openMessageContent( e ){
	if( $(e.target).hasClass('delete') ) return;
	if( $(e.target).hasClass('reply') ) return;
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
			if( $row.find(".content").length ){
				$row.find(".content").slideToggle("500",callbackAnimateSlide);
			}
			else{
				if( re.checked ){
					if( $row.find( '.checked' ).length ){
						$row.find( '.checked' ).html( re.checked );
						$row.addClass('viewed');
					}
				}				
				$row.append( $(re.content) );
				$row.find(".content").slideDown("500",callbackAnimateSlide);
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