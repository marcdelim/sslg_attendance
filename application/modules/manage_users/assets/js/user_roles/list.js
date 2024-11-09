$(document).ready(function () {
    list.execute();
});

var list = {
    execute : function(){
        $('#user-roles-list').dataTable({
            sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            scrollX: false,
            scrollY: "300px",
            "scrollCollapse": true,
            "processing": true,
            "serverSide": true,
            "destroy" : true,
            "ajax": {
                "url": urls.ajax_url,
                "type": "post",
                "dataType" : "json",
                "data" : function(d){
                    d.mod = "manage_users|user_roles_api|user_roles_list";
                },
                "dataSrc": function ( json ) {
                    var arrData = json.data;
                    for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                        arrData[i]['action'] = '<a href="'+urls.base_url+'manage_users/user_roles/'+arrData[i]['system_id']+'" system_id="'+arrData[i]['system_id']+'" class="btn-edit-user" title="View"><i class="fa fa-eye"></i></a>';
                    }
                    return arrData;
                }
            },"columns": [
                { "data": "name"},
                { "data": "description" },
                { "data": "action", "sortable" : false, "searchable" : false},
            ]
        });
    }
}