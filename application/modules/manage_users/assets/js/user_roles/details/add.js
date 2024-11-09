var addFunctionItems;
$(document).ready(function () {
    $('#btn-add').click(function(){
        addFunction.form();
    });
});

var addFunction = {
    form : function(){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            async : false,
            "data" : {
                mod : "manage_users|user_roles_api|add_form"
            },success : function(response){
                var formHTML = response;
                var formbox = bootbox.dialog({
                    message: formHTML,
                    title: 'Add Function',
                    className: "add-function",
                    size : "large",
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
                                addFunction.submit();
                                return false;
                            }
                        }
                    },
                    onEscape: false
                });
                formbox.on("shown.bs.modal", function() {
                    addFunction.list();
                });
                formbox.on('hidden.bs.modal', function () {
                    data_list();
                  })
            },error : function(response){
                console.log(response);
            }
        });
    },
    submit : function(){
        var arrData = [];
        var trs = $("input:checked").closest("tbody tr");
        var indexes = $.map(trs, function(tr) { return $(tr).index(); });
        $.each(indexes,function(index,value){
            arrData.push({
                user_role_id : $('#user_role_id').val(),
                module_function_id : addFunctionItems.row(value).data().id
            });
        });
        if(arrData.length <= 0){
            return false;
        }
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "manage_users|user_roles_api|add_function",
                data : arrData
            },success : function(response){
                console.log(response);
                toastr[response.status](response.message,"","toast-top-right");
                if(response.status == "success"){
                    addFunction.list();
                }
            },error : function(response){
                console.log(response);
            }
        });
    },
    list : function(){
        addFunctionItems = $('#function-list').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy" : true,
            "order": [[ 1, "asc" ]],
            "ajax": {
                "url" : urls.ajax_url,
                "type": "post",
                "dataType" : "json",
                "data" : function(d){
                    d.mod = "manage_users|user_roles_api|_functions";
                    d.show_available = $('#user_role_id').val();
                },
                "dataSrc": function ( json ) {
                    var arrData = json.data;
                    for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                        arrData[i]['edit'] = '<input type="checkbox" name="function_id" value="'+arrData[i]['id']+'" >';
                    }
                    return arrData;
                }
            },"columns": [
                { "render": function(data, type, full, meta){
                    return full.edit;
                },"bSortable" : false, "bSearchable" : false},
                { "data": "menu_description" },
                { "data": "function_description" },
            ]
        });
    }
}
