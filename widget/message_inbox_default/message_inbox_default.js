$(function () {
	$("body").on( "click",".message-list .row", openMessageContent );
	$("body").on( "click",".message-list .row .delete", deleteMessage );
});

function openMessageContent( e ){
	if( $(e.target).hasClass('delete') ) return;

	var $row = $(this);
	var no = $row.attr('no');

	var request = $.ajax({
		url: "/message/ajax/load",
		data: { id : no }
	});

	request.done(function( data ) {
		re = JSON.parse(data);
		if( !re.error ){
			if( $row.find(".content").length ){
				$row.find(".content").slideToggle();
			}
			else{
				$row.append( $(re.content) );
				$row.find(".content").slideDown();
			}
		}
	});

	request.fail(function( jqXHR, textStatus ) {
		alert( "Request failed: " + textStatus );
	});
}

function deleteMessage(){
	re = confirm("Are you sure you want to delete this message?");
	if( !re ) return;
	
	var $row = $(this).parent();
	var no = $row.attr('no');
	
	var last_no = $(".message-list .row:last").attr('no');
	
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