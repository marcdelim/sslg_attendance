$(document).ready(function () {
    list.execute();
});

var list = {
    execute : function(){
        $('#users-list').DataTable({
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
                    d.mod = "manage_users|users_api|users_list";
                },
                "dataSrc": function ( json ) {
                    var arrData = json.data;
                    for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                        arrData[i]['action'] = $('#btn-edit-enable').html() == true ? '<a href="#" user_id="'+arrData[i]['user_id']+'" class="btn-edit-user" title="Edit"><i class="fa fa-edit"></i></a>' : "";
                    }
                    return arrData;
                }
            },"columns": [
                { "data": "user_id"},
                { "data": "username" },
                { "data": "fullname" },
                { "data": "role" },
                { "data": "date_created" },
                { "data": "position_name" },
                { "data": "sales_person_code" },
                { "data": "region" },
                { "data": "module" },
                { "data": "slspn_bu" },
                { "data": "expiration_date" },
                { "data": "action", "sortable" : false, "searchable" : false},
            ]
        });
    }
}