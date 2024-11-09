$(document).ready(function () {
    $('body').on('click','.btn-remove',function(){
        var id = $(this).attr('id');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
         //   type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#F9354C',
            cancelButtonColor: '#41B314',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(){
           
            $.ajax({
                "url": urls.ajax_url,
                "type": "POST",
                "async" : false,
                "dataType" : "json",
                "data" : {
                    mod : "manage_users|user_roles_api|remove_function",
                    data : {
                        id : id
                    }
                },success : function(response){
                    console.log(response);
                    toastr[response.status](response.message,"","toast-top-right");
                    if(response.status == "success"){
                        data_list();
                    }
                },error : function(response){
                    console.log(response);
                }
            })
            
        })
    }); 
});