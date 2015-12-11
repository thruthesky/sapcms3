$ = jQuery;

$(function(){
    $("body").on("click",".change-password", callbackChangePassword);
	$("body").on("click",".slide-menu-button", toggleSlideMenu);

	$("body").click(function( e ){
		var element_class = $(e.target).prop("class");
		if( $(e.target).parents(".slide-menu").length ) return;
		else if( $(e.target).parent().hasClass(".slide-menu") ) return;
		else if( $(e.target).hasClass("slide-menu") ) return;
		else if( $(e.target).hasClass("slide-menu-button") ) return;
		else if( $(e.target).parents(".slide-menu-button").length ) return;
		else if( $(e.target).parent().hasClass(".slide-menu-button").length ) return;

		toggleSlideMenu();
	});
});

function toggleSlideMenu(){
	header_height = $(".header").height();
	$(".slide-menu").css("top",header_height)

	$(".slide-menu").animate({
		width: "toggle"
	}, function(){
		
	});
}

function callbackChangePassword(){
    $this = $(this);
    $this.after( htmlCreateChangePasswordBox() );
    $this.remove();
}

function htmlCreateChangePasswordBox(){
    /*
     html =	"<input type='password' name='old_password'>" +
     "<input type='password' name='password'>" +
     "<input type='password' name='password_confirm'>";
     */
    html =	"<input type='password' name='password'>";
    return html;
}
