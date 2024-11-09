$(document).ready(function () {
    selSslg();
});


function selSslg(){
    $('#time_in_form #sslg_officers_id').select2({
        allowClear: true,
        dropdownParent: $('#time_in_form'),
        placeholder: '--Please select--',
        ajax: {
            url: urls.ajax_url,
            type: "POST",
            async: false,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    mod: "sslg_officers|sslg_officers_api|list",
                    search: {value: params.term },  
                    columns: [
                                { data: 'full_name'},
                                { data: 'position'}
                            ]
                };
            }, processResults: function (response) {
                var data = new Array();
                response = response.data;
                if (response !== null) {
                    for (var x = 0; x < response.length; x++) {
                        data.push({
                            id: response[x].id,
                            text: response[x].position + ' : ' + response[x].full_name,
                        });
                    }
                    console.log(data);
                }
                return { results: data };
            }
        }
    });

}

