var externalAPI = new Array();
$(document).ready(function(){
    $.ajax({
        "url": urls.ajax_url,
        "type": "POST",
        "async" : false,
        "dataType" : "json",
        "data" : {
            mod : "auth|auth_api|external_api"
        },success : function(response){
            externalAPI = response;
        },error : function(response){
            console.log(response);
        }
    });
});