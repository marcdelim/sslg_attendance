$(document).ready(function () {
    maintenance_type();
});

function maintenance_type(){
    $('#maintenance-type').dataTable({
        "processing": true,
        "serverSide": true,
        "destroy" : true,
        "ajax": {
            "url" : urls.ajax_url,
            "type": "post",
            "dataType" : "json",
            "data" : function(d){
                d.mod = "maintenance|maintenance_api|get_maintenance_type";
            },
            "dataSrc": function ( json ) {
                var arrData = json.data;
                for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                    arrData[i]['code'] = '<button class="btn btn-info btn-xs btn-search" item_id="'+arrData[i]['code']+'"><i class="fa fa-search"></i></button>';
                }
                console.log(arrData);
                return arrData;
            }
        },"columns": [
            { "data": "name" },
            { "data": "description" },
            { "data": "code" },
        ]
    });
}