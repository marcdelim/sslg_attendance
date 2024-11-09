$(document).ready(function () {
    $('#btn-edit-dtls').on('click', function(){
        swal.fire({
            title: 'Edit Details',
            html:
            'Role Name:<input class="swal2-input" placeholder="*Name" id="name" value="'+arrDetails.name+'">'+
            'Description:<textarea class="swal2-textarea" placeholder="*Description" id="description">'+arrDetails.description+'</textarea>',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            allowEscapeKey : false,
            preConfirm: function(){
            //    let promise = new Promise(function(resolve, reject){
                    if($('#name').val() == ""){
                        swal.showValidationMessage('Name is required!');
                    }else if($('#description').val() == ""){
                        swal.showValidationMessage('Description is required!');
                    }else{
                      //  resolve();
                    }
           //     });
            }
        }).then(function(result){
            if (result.isConfirmed) {
            $.ajax({
                "url": urls.ajax_url,
                "type": "POST",
                "async" : false,
                "dataType" : "json",
                "data" : {
                    mod : "manage_users|user_roles_api|update_details",
                    data : {
                        id : $('#user_role_id').val(),
                        name : $('#name').val(),
                        description : $('#description').val(),
                    }
                },success : function(response){
                    toastr[response.status](response.message,"","toast-top-right");
                    if(response.status == "success"){
                        details();
                    }
                },error : function(response){
                    console.log(response);
                }
            });
            }
        })
    });
});
