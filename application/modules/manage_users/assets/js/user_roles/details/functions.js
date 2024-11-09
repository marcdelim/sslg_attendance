var table;
$(document).ready(function () {
    data_list();
});

function data_list(){
    table = $('#tbl-functions').DataTable({
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "processing": true,
        "serverSide": true,
        "destroy" : true,
        "ajax": {
            "url" : urls.ajax_url,
            "type": "post",
            "dataType" : "json",
            "data" : function(d){
                d.mod = "manage_users|user_roles_api|_functions";
                d.user_role_id = $('#user_role_id').val();
            },
            "dataSrc": function ( json ) {
                var arrData = json.data;
                for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                    arrData[i]['role_function_id'] = $('#btn-edit-enable').html() == true ? '<button class="btn btn-danger btn-xs btn-remove" id="'+arrData[i]['role_function_id']+'"><i class="fa fa-trash"></i> Remove</button>' : "";
                }
                return arrData;
            }
        },"columns": [
            { "data": "menu_description" },
            { "data": "function_description" },
            { "data": "role_function_id", "bSortable" : false, "bSearchable" : false },
            
        ]
    });
}