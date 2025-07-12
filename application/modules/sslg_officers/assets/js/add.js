$(document).ready(function () {
    $('#btn-add').prop("disabled",false);
    $('#btn-add').click(function(){
        add.form();
    });
});

var add = {
    form : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "data" : {
                mod : "sslg_officers|sslg_officers_api|create_form"
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'SSLG Officers',
                    className: "frm-add",
                    size : "xl",
                    buttons: {
                        "cancel": {
                            label: "Close",
                            className: "btn-danger",
                            callback: function() {
                                
                            }
                        },
                        "go": {
                            label: 'Submit',
                            className: "btn-primary",
                            callback: function() {
                                if(add.validate()){
                                    add.submit();
                                }
                                return false;
                                
                            }
                        }
                    }
                });
                formbox.on("shown.bs.modal", function() {
                    
                });
            },error : function(response){
                console.log(response);
            }
        });
    },
    validate : function(){
        return $('.frm-add #frm-add').valid();
    },
    submit : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "sslg_officers|sslg_officers_api|create",
                data : $('.frm-add #frm-add').serialize()
            },success : function(response){
                swal({
                    type: response.status,
                    title: response.message
                }).then(function(){
                    if(response.status == 'success'){
                        location.reload();
                    }
                });
            },error : function(response){
                console.log(response);
                swal({
                    type: "error",
                    title: "An error occurred!"
                });
            }
        });
    }
};