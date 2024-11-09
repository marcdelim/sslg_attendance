$(document).ready(function () {
    user.edit_form();
});

var user = {
    edit_form : function(){
        $('body').on('click','.btn-edit-user',function(e){
            e.preventDefault();
            var user_id = $(this).attr('user_id');
            $.ajax({
                "url": urls.ajax_url,
                "type": "POST",
                "data" : {
                    mod : "manage_users|users_api|edit_form",
                    data : {
                        user_id : user_id
                    }
                },success : function(response){
                    var formHTML = response;
                    var formbox = bootbox.dialog({
                        message: formHTML,
                        title: 'Edit User',
                        className: "edit-user",
                        size : "xl",
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
                                    if(user.validate()){
                                        user.submit(user_id);
                                    }
                                    return false;
                                }
                            }
                        }
                    });
                    $(function () {
                        $('.datetimepicker').datepicker({
                            format: "yyyy-mm-dd"
                        });
                    });
                    user.reset_password(user_id);
                },error : function(response){
                    console.log(response);
                }
            });
        });
    },
    validate : function(){
        $('#user_profile_form').validate({
            errorElement: 'span',
            rules : {
                email_address : "email",
            }
        });
        var valid = false;
        if($('#user_profile_form').valid()){
            valid = true;
        }
        return valid;
    },
    submit : function(user_id){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "manage_users|users_api|update_user",
                data : {
                    user_id : user_id,
                    profile : $('#user_profile_form').serialize()
                }
            },success : function(response){
                swal({
                    type: response.status,
                    title: response.message
                });
                if(response.status == "success"){
                    list.execute();
                    $(".edit-user").modal('hide');
                }
            },error : function(response){
                console.log(response);
            }
        });
    },
    reset_password : function(user_id){
        $('body').on('click','.btn-reset-password',function(){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#F9354C',
                cancelButtonColor: '#41B314',
                confirmButtonText: 'Yes!'
            }).then(function(){
                $.ajax({
                    "url": urls.ajax_url,
                    "type": "post",
                    "dataType" : "json",
                    "data" : {
                        mod : "manage_users|users_api|reset_password",
                        data : {
                            user_id : user_id
                        }
                    },success : function(response){
                        swal({
                            type: response.status,
                            title: response.message
                        });
                    },error : function(response){
                        console.log(response);
                    }
                });
            }).catch(swal.noop);
        });
    }
}