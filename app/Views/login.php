<!DOCTYPE html>
<html>
<?= $this->include('templates/header') ?>
<body class="bg-dark">
   <!--  <?php echo base_url(); ?> -->
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Admin Login</div>
            <div class="card-body">
                <form method="POST" id="form_login" name="form_login">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                            <label id="username_id" for="username">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                            <label for="password" id="password_id" >Password</label>
                        </div>
                    </div>
                     <div class="text-center">
                    </div>
                   <button type="submit" class="btn btn-primary btn-block">Login</button>                    
                </form>
            </div>
        </div>
    </div>

   <?= $this->include('templates/footer') ?>
  
  <script> 
    $("#form_login").validate({
          ignore: [],
          debug: false,
         rules: {
          email: "required",
          password: "required",
    
       },
      messages: {
          email: "please enter email",  
          password: "please enter password",    
      },
      errorElement: "em",
      submitHandler: function () {
        var formData = new FormData(form_login);
       $.ajax({
           type: 'POST',
           url: BASE_URL+"login/authenticate",
           data: formData,
           processData: false,
           contentType: false,
           success: function (response) { 
            //    console.log(response);
                // var data=$.parseJSON(data);
                if(response.status==true){
                    window.location.href = BASE_URL+'dashboard';             
                }else{
                    error_message('Warning',response.message);
                    $('#form_login')[0].reset();
                }
                //      if(data.status =="1"){           
                //           window.location.href='<?php echo base_url();?>/dashboard';                   
                //      }else{
                //         alertify.alert("Error",data.message, function () { });
                //         return false;
                //    }   
                    
                 }           
       });
            
      }
  });

  </script>

</body>

</html>