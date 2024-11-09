$(document).ready(function(){
    $('#btn-change-pass').click(function(e){
        e.preventDefault();
        $('#form_force_change_pass').validate({
            errorElement: 'span',
            rules : {
                re_new_password : {
                    equalTo : '#new_password'
                }
            }
        });
        
        if($('#form_force_change_pass').valid()){
            $.ajax({
                "url": urls.ajax_url,
                "type": "post",
                "dataType" : "json",
                "async" : false,
                "data" : {
                    mod : "manage_users|users_api|force_change_password",
                    data : {
                        user_id : $('#user_id').val(),
                        password : $('#re_new_password').val()
                    }
                },success : function(response){
                    if(response.status == "success"){
                        window.location.href = urls.base_url+"auth/logout"; 
                    }
                },error : function(response){
                    console.log(response);
                }
            });
        }
    });

    $('body').keypress(function(e) {
		if(e.which == 13) {
			$(this).find('#btn-change-pass').click();
		}
	});
});