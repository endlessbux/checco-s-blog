$('.form-control.border-danger').keypress(function(){
	$(this).removeClass('border');
	$(this).removeClass('border-danger');
	$('small[err='+$(this).attr('id')+']').remove();
});

$('.text-danger .required-checkbox').change(function(){
	$(this).parent().removeClass('text-danger');
	$('small[err='+$(this).attr('id')+']').remove();
	console.log('si');
});

$('.pw-toggle').click(function(){
	$('#toggle-icon').toggleClass("fa-eye fa-eye-slash");
	var pw	=	$(this).attr("toggle");
	if($(pw).attr("type") == 'password'){
		$(pw).attr("type","text");
	}else{
		$(pw).attr("type","password");
	}
});
