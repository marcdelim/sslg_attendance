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
            "destroy" : true,
            "order": [[ 0, "asc" ]],
            buttons : [
                { extend: 'excel',
                  title: 'Company',
                  exportOptions: {
                    columns: ":not(.not-export-column)",
                    columns: ':gt(0)'
                 }
                },
            ],
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
                    d.mod = "attendance|attendance_api|list";
                },
                "dataSrc": function ( json ) {
                    var arrData = json.data;
                    if(json.type === "no_transaction"){
                        return new Array();
                    }
                    for ( var i=0;i< arrData.length;i++ ) {
                        arrData[i]['sel'] = '<input type="checkbox">';
                        arrData[i]['view'] = '<button class="btn-success btn-xs btn-view"><i class="fa fa-eye"></i></button>';
                    }
                    return arrData;
                }
            },"columns": [
                { "data": "id" },
                { "data": "full_name" },
                { "data": "position" },
                { "data": "time_in" },
                { "data": "time_out" },
                { "render": function(data, type, full, meta){
                    return full.view;
                },"bSortable" : false, "bSearchable" : false},
            ]
        });
    }
};