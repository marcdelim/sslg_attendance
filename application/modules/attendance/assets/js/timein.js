$(document).ready(function () {
    $('#submit_btn').click(function(e){
        e.preventDefault();
        if(save.validate()){
            save.submit();
        }
    });
});

var save = { 
    validate : function(){
        var valid = false;
        if($('#time_in_form').valid()){
            valid = true;
        }
        return valid;
    },
    submit : function(){
        var data = {
            time_in_details : $('#time_in_form').serialize(),
          
        };
        swal({
            allowEscapeKey  : false,
            allowOutsideClick : false,
            showConfirmButton : false,
            title: "Loading ...",
            onOpen: function(){
                setTimeout(function(){
                    $.ajax({
                        "url": urls.ajax_url,
                        "type": "POST",
                        "dataType" : "json",
                        "data" : {
                            mod : "attendance|attendance_api|save",
                            data : data
                        },success : function(response){
                            swal({
                                type: response.status,
                                title: response.message,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then(function(){
                                if(response.status == 'success'){
                                    location.reload();
                                }
                            });
                        },error : function(response){
                            console.log(response);
                        }
                    });
                });
            }
        });
       
    },
   
}