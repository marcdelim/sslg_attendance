var table;
$(document).ready(function () {
    data.list();
    $('#btn-export').on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
});

var data = {
    list : function(){
        table = $('#tbl-list').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX" : true,
            "destroy" : true,
            "order": [[ 0, "asc" ]],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "ajax": {
                "url": urls.ajax_url,
                async :false,
                "type": "post",
                "dataType" : "json",
                "data" : function(d){
                    d.mod = "sslg_officers|sslg_officers_api|list";
                },
                "dataSrc": function ( json ) {
                    var arrData = json.data;
                    if(json.type === "no_transaction"){
                        return new Array();
                    }
                    for ( var i=0;i< arrData.length;i++ ) {
                        arrData[i]['edit'] = '<button class="btn-success btn-xs btn-edit"><i class="fa fa-edit"></i></button>';
                    }
                    return arrData;
                }
            },"columns": [
                { "data": "id" },
                { "data": "position" },
                { "data": "full_name" },
                { "render": function(data, type, full, meta){
                    return full.edit;
                },"bSortable" : false, "bSearchable" : false},
            ]
        });
    }
};