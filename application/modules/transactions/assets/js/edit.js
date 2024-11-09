$(document).ready(function () {
    $('body').on('click','.btn-edit',function(){
        var transaction_id = $(this).attr('item_id');
        edit.form(transaction_id);
    });
});

var edit = {
    form : function(transaction_id){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "data" : {
                mod : "transactions|transactions_api|edit_form",
                data : {
                    transaction_id : transaction_id,
                }
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'Edit Transaction',
                    className: "edit-transaction",
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
                                if(edit.validate()){
                                    swal({
                                        allowEscapeKey: false,
                                        allowOutsideClick: false,
                                        showConfirmButton: false,
                                        title: "Saving..."
                                    });
                                    edit.submit(transaction_id);
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
        return $('#edit-transaction-form').valid();
    },
    submit : function(transaction_id){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "transactions|transactions_api|update_transaction",
                data : {
                    transaction_id : transaction_id,
                    description : $('.modal-body #description').val(),
                    school_year : $('.modal-body #start').val()+" - "+$('#end').val(),
                    previous_year : $('.modal-body #previous_year').val(),
                    current_year : $('.modal-body #current_year').val(),
                    next_year : $('.modal-body #next_year').val(),
                    status : $('.modal-body #status').val(),
                    locked : $('.modal-body #locked').val(),
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