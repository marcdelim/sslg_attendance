$(document).ready(function () {
    $('#maintenance-value tbody').on( 'dblclick', 'tr', function () {
        console.log( table_value.row( this ).data() );
        var details = table_value.row( this ).data();
        editValue.form(details);
    });
});

var editValue = {
    form : function(details){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            async : false,
            "data" : {
                mod : "maintenance|maintenance_api|edit_value_form",
                data : details
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'Edit',
                    className: "maintenance-value-details",
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
                                if(editValue.validate()){
                                    editValue.submit({
                                        id : $('#id').val(),
                                        name : $('#name').val(),
                                        description : $('#description').val(),
                                        status : $('#status').val(),
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
        $(".maintenance-value-details").modal('hide');
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            async : false,
            dataType : "json",
            "data" : {
                mod : "maintenance|maintenance_api|update_value",
                data : data
            },success : function(response){
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
        return $('#form-edit-value-details').valid();
    }
}