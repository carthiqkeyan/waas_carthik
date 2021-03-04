// error message
function error_message(title,message){
    Swal.fire({
        icon: 'warning',
        title: title,
        text: message
      });
}

// success message
function success_message(message,redirect_url=''){
    Swal.fire({
        icon: 'success',
        text: message
      }).then((result) => {
        if(redirect_url!=''){
           window.location.href = BASE_URL+''+redirect_url;
        }
      });
}

// confirmation message
function delete_confirmation_message(params,action_url){
    Swal.fire({
        title: 'Are you sure that you want to delete this record?',
        // text: del_msg,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: "POST",
                url: action_url,
                data : params,
                    success: function(response) {
                        if(response.status == true){
                            Swal.fire({
                                text: response.message,
                                icon: "success"
                              }).then((result) => {
                                //   window.location=url;
                                window.location.reload();
                              });
                        }
                    }
                });
                // window.location.reload(true);
        }
      })
}

function cus_status_confirmation_message(params,action_url){
    Swal.fire({
        title: 'Are you sure that you want suspend/revoke this account?',
        // text: del_msg,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: "POST",
                url: action_url,
                data : params,
                    success: function(response) {
                        if(response.status == true){
                            Swal.fire({
                                text: response.message,
                                icon: "success"
                              }).then((result) => {
                                //   window.location=url;
                                window.location.reload();
                              });
                        }
                    }
                });
                // window.location.reload(true);
        }
      })
}