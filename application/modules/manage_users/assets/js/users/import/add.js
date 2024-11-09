$(document).ready(function () {
    $('#chkBox-select-all').on('click', function(){
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
    $('#btn-add-users').click(function(){
        var arrData = [];
        var trs = $("input:checked").closest("tbody tr");
        var indexes = $.map(trs, function(tr) { return $(tr).index(); });
        $.each(indexes,function(index,value){
            arrData.push(table.row(value).data());
        });
        if(arrData.length > 0){
            addUser.submit(arrData);
        }
    });
});

var addUser = {
    submit : function(data){
        $.ajax({
            "url": urls.ajax_url,
            "type": "POST",
            "async" : false,
            "dataType" : "json",
            "data" : {
                mod : "manage_users|users_api|import_users",
                data : data
            },success : function(response){
                swal({
                    type: response.status,
                    title: response.message
                });
                if(response.status == "success"){
                    ssoUsers();
                }
            },error : function(response){
                console.log(response);
            }
        });
    }
}