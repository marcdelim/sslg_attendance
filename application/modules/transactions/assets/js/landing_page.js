var tblFilters = {};
$(document).ready(function () {
    $( '#formFilters'  ).on( 'keyup', ".tblFilter",function () {
        $( ".tblFilter" ).each(function() {
            var val = $(this).val();
            var name = $(this).attr('name');
            if(val !== ""){
                tblFilters[name] = val;
                transaction_list(tblFilters);
            }
        });
    } );
    transaction_list(tblFilters);
});

function transaction_list(filters = {}){
    $('#tbl-transactions').dataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "destroy" : true,
        "searching": false,
        "ajax": {
            "url": urls.ajax_url,
            "type": "post",
            "dataType" : "json",
            "data" : function(d){
                d.mod = "transactions|transactions_api|transaction_list";
                if(jQuery.isEmptyObject(filters) === false){
                    d.filters = filters;
                }
            },
            "dataSrc": function ( json ) {
                var arrData = json.data;
                console.log(arrData);
                for ( var i=0, ien=arrData.length ; i<ien ; i++ ) {
                    arrData[i]['edit'] = '<a href="#" item_id="'+arrData[i]['transaction_id']+'" class="btn-edit" title="Edit"><i class="fa fa-edit"></i></a>';
                    arrData[i]['locked'] = '<input type="checkbox" disabled '+(arrData[i]['locked'] == 1 ? 'checked' : '')+' >';
                }
                return arrData;
            }
        },"columns": [
            { "data": "transaction_id"},
            { "data": "description" },
            { "data": "school_year" },
            { "data": "status" },
            { "render": function(data, type, full, meta){
                return full.locked;
            },"bSortable" : false, "bSearchable" : false},
            { "render": function(data, type, full, meta){
                return full.edit;
            },"bSortable" : false, "bSearchable" : false},
        ]
    });
}