$ = jQuery;

$(function(){
    $("body").on("click",".change-password", callbackChangePassword);
    $(".slide-menu-button").click(function(){
		header_height = $(".header").height();
		$(".slide-menu").css("top",header_height)
	
        $(".slide-menu").animate({
            width: "toggle"
        }, function(){
			
		});
    });
});

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
