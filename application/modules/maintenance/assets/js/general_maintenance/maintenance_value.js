var table_value;
function maintenance_value(maintenance_type){
    table_value = $('#maintenance-value').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy" : true,
        "ajax": {
            "url" : urls.ajax_url,
            "type": "post",
            "dataType" : "json",
            "data" : function(d){
                d.mod = "maintenance|maintenance_api|maintenance_value";
                d.maintenance_type_code = maintenance_type;
                d.with_inactive = true;
            },
            "dataSrc": function ( json ) {
                var arrData = json.data;
                return arrData;
            }
        },"columns": [
            { "data": "code" },
            { "data": "name" },
            { "data": "description" },
            { "data": "status" },
        ]
    });
}