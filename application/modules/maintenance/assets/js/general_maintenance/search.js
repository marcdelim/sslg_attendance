$(document).ready(function () {
    $('body').on('click','.btn-search',function(){
        var maintenance_type_code = $(this).attr('item_id');
        $('#maintenance_type_selected').val(maintenance_type_code);
        maintenance_value(maintenance_type_code);
    });
});