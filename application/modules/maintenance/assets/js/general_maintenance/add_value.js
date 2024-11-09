$(document).ready(function () {
    $('#btn-add-value').click(function(){
        addValue.form();
    });
    
});

var addValue = {
    form : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            async : false,
            "data" : {
                mod : "maintenance|maintenance_api|add_value_form"
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'Add',
                    className: "maintenance-add-value-details",
                    size : "small",
                    buttons: {
                        "cancel": {
                            label: "Cancel",
                            className: "btn-default cancelBtn",
                            callback: function() {
                                
                            }
                        },
                        "go": {
                            label: 'Submit',
                            className: "btn-primary",
                            callback: function() {
                                if(addValue.validate()){
                                    addValue.submit({
                                        maintenance_type_code : $('#maintenance_type_selected').val(),
                                        code : $('#code').val(),
                                        name : $('#name').val(),
                                        description : $('#description').val(),
                                    });
                                }
                                return false;
                            }
                        }
                    },
                    onEscape: false
                });
                formbox.on("#tbl-items shown.bs.modal", function() {
                    // AutoCapitalizeInputs();
                });
            },error : function(response){
                console.log(response);
            }
        });
    },
    submit : function(data){
        $(".maintenance-add-value-details").modal('hide');
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            async : false,
            dataType : "json",
            "data" : {
                mod : "maintenance|maintenance_api|add_value",
                data : data
            },success : function(response){
                console.log(response);
                swal({
                    title: response.message,
                    type: response.status,
                }).then(function(){
                    if(response.status == "success"){
                        maintenance_value(response.data.maintenance_type);
                    }
                });
            },error : function(response){

            }
        });
    },
    validate : function(){
        return $('#form-add-value-details').valid();
    }
}