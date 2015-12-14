$ = jQuery;
$(function(){
	$("body").on("click",".input-group.password.text-only .form-control", callbackChangePasswordPhilzine );
});

function callbackChangePasswordPhilzine(){
	var $this = $(this);
	var $parent = $this.parent()
	var html = "<input name='password'  type='password' class='form-control' placeholder='Enter password'>";
	$parent.removeClass("text-only");
	$parent.prepend( html );
	$this.remove();
	$parent.find( "input" ).focus();
}