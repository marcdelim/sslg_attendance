$(document).ready(function () {
    $('body').on('click','.btn-view',function(){
        var data = table.row($(this).parents('tr')).data();
        view.form(data.id);
    });
});

var view = {
    form : function(id){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "data" : {
                mod : "attendance|attendance_api|view_form",
                data : {
                    id : id
                }
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'View',
                    className: "frm-view",
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
                                if(view.validate()){
                                    view.submit(id);
                                }
                                return false;
                                
                            }
                        }
                    }
                });
            },error : function(response){
                console.log(response);
            }
        });
    },
    validate : function(){
        return $('.frm-view #frm-view').valid();
    },
    submit : function(id){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "attendance|attendance_api|update",
                data : {
                    id : id,
                    details : $('.frm-view #frm-view').serialize()
                
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
            }
        });
    }
};