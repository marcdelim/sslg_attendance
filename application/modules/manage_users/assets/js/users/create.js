$(document).ready(function () {
    create_user.form();
});

var create_user = {
    form : function(){
        $('#btn-create').click(function(e){
            e.preventDefault();
            $.ajax({
                "url": urls.ajax_url,
                "type": "POST",
                "data" : {
                    mod : "manage_users|users_api|create_form"
                },success : function(response){
                    var formHTML = response;
                    var formbox = bootbox.dialog({
                        message: formHTML,
                        title: 'Create User',
                        className: "create-user",
                        size : "medium",
                        buttons: {
                            "cancel": {
                                label: "Cancel",
                                className: "btn-default cancelBtn",
                                callback: function() {
                                    
                                }
                            },
                            "go": {
                                label: 'Submit',
                                className: "btn-danger",
                                callback: function() {
                                    if(create_user.validate()){
                                        create_user.submit();
                                    }else{
                                        return false;
                                    }
                                }
                            }
                        }
                    });
                },error : function(response){
                    console.log(response);
                }
            });
        });
    },
    validate : function(){
        $('#create-user-form').validate({
            errorElement: 'span',
            rules : {
                email_address : "email",
                // username : "notExist"
            }
        });
        return $('#create-user-form').valid();
    },
    submit : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "manage_users|users_api|create_user",
                data : $('#create-user-form').serialize()
            },success : function(response){
                swal({
                    type: response.status,
                    title: response.message
                });
                if(response.status == "success"){
                    list.execute();
                }
            },error : function(response){
                console.log(response);
            }
        });
    }
}