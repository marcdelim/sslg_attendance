$(document).ready(function () {
    $('#btn-create').click(function(){
        create.form();
    });
});

var create = {
    form : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "data" : {
                mod : "transactions|transactions_api|create_form"
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'Create Transaction',
                    className: "create-transaction",
                    size : "medium",
                    buttons: {
                        "cancel": {
                            label: "Cancel",
                            className: "btn-default",
                            callback: function() {
                                
                            }
                        },
                        "go": {
                            label: 'Submit',
                            className: "btn-danger",
                            callback: function() {
                                if(create.validate()){
                                    swal({
                                        allowEscapeKey: false,
                                        allowOutsideClick: false,
                                        showConfirmButton: false,
                                        title: "Saving..."
                                    });
                                    create.submit();
                                }else{
                                    return false;
                                }
                            }
                        }
                    }
                });
                $(function () {
                    $('.datetimepicker').datetimepicker({
                        format: 'YYYY'
                    });
                });
            },error : function(response){
                console.log(response);
            }
        });
    },
    validate : function(){
        return $('#create-transaction-form').valid();
    },
    submit : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "transactions|transactions_api|create_transaction",
                data : {
                    description : $('.modal-body #description').val(),
                    school_year : $('.modal-body #school_year').val(),
                }
            },success : function(response){
                swal({
                    type: response.status,
                    title: response.message
                });
                if(response.status == "success"){
                    transaction_list(tblFilters);
                }
            },error : function(response){
                console.log(response);
            }
        });
    }
}