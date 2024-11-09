$(document).ready(function () {
    $('#btn-create').on('click', function(){
        swal({
            title: 'Create New Role',
            html:
            '<input class="swal2-input" placeholder="*Name" id="name">'+
            '<textarea class="swal2-textarea" placeholder="*Description" id="description"></textarea>',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            allowEscapeKey : false,
            preConfirm: function(){
                return new Promise(function(resolve, reject){
                    if($('#name').val() == ""){
                        reject('Group name is required!');
                    }else if($('#description').val() == ""){
                        reject('Description name is required!');
                    }else{
                        resolve();
                    }
                });
            }
        }).then(function(){
            $.ajax({
                "url": urls.ajax_url,
                "type": "POST",
                "async" : false,
                "dataType" : "json",
                "data" : {
                    mod : "manage_users|user_roles_api|_create",
                    data : {
                        name : $('#name').val(),
                        description : $('#description').val(),
                    }
                },success : function(response){
                    console.log(response);
                    toastr[response.status](response.message,"","toast-top-right");
                    if(response.status == "success"){
                        list.execute();
                    }
                },error : function(response){
                    console.log(response);
                }
            });
        }).catch(swal.noop);
    });
});
