var table;
$(document).ready(function () {
    ssoUsers();
    $('#sales_person_code').keyup(function(){
        ssoUsers();
    });
    $('#region').keyup(function(){
        ssoUsers();
    });
});
function ssoUsers(){
    table = $('#sso-users-list').DataTable({
        "scrollX": true,
        "scrollCollapse": true,
        "processing": true,
        "serverSide": true,
        "destroy" : true,
        "order": [[ 1, "asc" ]],
        "ajax": {
            "url": urls.ajax_url,
            "type": "post",
            async: false,
            "dataType" : "json",
            "data" : function(d){
                d.mod = "manage_users|users_api|sso_users_list";
                d.recordsTotal = true;
                d.recordsFiltered = true;
                d.filters = {
                    sales_person_code : $('#sales_person_code').val(),
                    region : $('#region').val(),
                }
            },
            "dataSrc": function ( json ) {
                var arrData = json.data;
                console.log(arrData);
                for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                    arrData[i]['edit'] = '<input type="checkbox" name="user_id" value="'+arrData[i]['user_id']+'">';
                }
                return arrData;
            }
        },"columns": [
            { "render": function(data, type, full, meta){
                return full.edit;
            },"bSortable" : false, "bSearchable" : false},
            {"data" : "user_id"},
            {"data" : "username"},
            {"data" : "fullname"},
            {"data" : "position_name"},
            {"data" : "department_name"},
            {"data" : "company_name"},
            {"data" : "sales_person_code"},
            {"data" : "region"},
            {"data" : "slspn_bu"},
        ]
    });
}