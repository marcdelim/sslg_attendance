$(document).ready(function () {
    $('body').on('click','.btn-edit',function(){
        var data = table.row($(this).parents('tr')).data();
        edit.form(data.id);
    });
});

var edit = {
    form : function(id){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "data" : {
                mod : "sslg_officers|sslg_officers_api|edit_form",
                data : {
                    id : id
                }
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'SSLG Officers',
                    className: "frm-edit",
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
                                if(edit.validate()){
                                    edit.submit(id);
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
        return $('.frm-edit #frm-edit').valid();
    },
    submit : function(id){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "sslg_officers|sslg_officers_api|update",
                data : {
                    id : id,
                    details : $('.frm-edit #frm-edit').serialize()
                }
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