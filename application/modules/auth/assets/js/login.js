$(document).ready(function(){
    // $(".right").css("background-image","url()");

    $('#btn-login').click(function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "dataType" : "json",
            "data" : {
                mod : "auth|auth_api|login",
                username : $('#username').val(),
                password : $('#password').val()
            },success : function(response){
                if(response.status == "success"){
                    location.reload();
                }else{
                    $('#error-message').html(response.message);
                }
                console.log(response);
            },error : function(response){
                console.log(response);
            }
        });
    });

    $('body').keypress(function(e) {
		if(e.which == 13) {
			$(this).find('#btn-login').click();
		}
	});
});