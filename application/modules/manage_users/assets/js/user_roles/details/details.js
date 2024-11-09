var arrDetails = new Array();
$(document).ready(function () {
    details();
});

function details(){
    $.ajax({
        "url": urls.ajax_url,
        "type": "POST",
        "async" : false,
        "dataType" : "json",
        "data" : {
            mod : "manage_users|user_roles_api|user_roles_list",
            id : $('#user_role_id').val()
        },success : function(response){
            response = response.data;
            arrDetails = response;
            $('#dtls_name').val(response.name);
            $('#dtls_description').val(response.description);
        },error : function(response){
            console.log(response);
        }
    })
}