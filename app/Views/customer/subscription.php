<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-3 border-bottom pb-2">
       <div class="col-sm-6">
          <h1 class="m-0 text-dark">Customer Subscription</h1>
          <small>Create users / Customer assign user roles as per customer</small>
       </div>

       <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
       </div>
  </div>

<div class="row mb-2">
       <div class="col-sm-12">
<div class="card">
<div class="card-body">
 <form role="form" id="form_subscription" name="form_subscription" >

    <div class="text-danger" id='role_error' name='role_error'>
    </div>
   
			<div class="box-body">
      <div class="row">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Start Date</label>
      <input type="date" class="form-control" id="start_date" name="start_date" placeholder="" required>
      </div>
    </div>
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">End Date</label>
      <input type="date" class="form-control" id="end_date" name="end_date" placeholder="" required>
      </div>
    </div>
    </div>

    <div class="row">
    <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Status</label>
        <?php
          $statusArr = [array("id"=>"1","name"=>"Active"), array("id"=>"0","name"=>"Inactive")];
        ?>
         <select id="status"  class="form-control"  name="status" placeholder="">
          <?php
            foreach($statusArr as $value) {
                $selected = (isset($arr_subDetails['status']) && $arr_subDetails['status'] == $value['id']) ? 'selected' : '';
              ?>
                <option value="<?php echo  $value['id']; ?>" <?= $selected; ?>><?php echo $value['name'];?></option>
              <?php
            }
          ?>                
        </select>
      </div>
      </div>
      </div>
      </div>
     </div>
    
			</div>

       <table id="role_datatable" name="role_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Package</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               <tbody>
                <?php
                if (is_array($arr_subscription) && count($arr_subscription) != 0) {
                    foreach ($arr_subscription as $key=>$subscription) {
                ?>
  
                    <tr>
                        <td><?= ++$key;?></td>
                        <td><?= $subscription['name'];?></td>
                        <td><?= $subscription['package_month'];?></td>
                        <td><?= $subscription['start_date'];?></td>
                        <td><?= $subscription['end_date'];?></td>
                        <td><?= ($subscription['status']==1)?"Active":"Inactive";?></td>
                        <td style="position: relative;">      
                                   
                         <div class="action_menu_btn" rel="<?php echo $key; ?>">
                          <button class="more-btn">
                              <span class="more-dot"></span>
                              <span class="more-dot"></span>
                              <span class="more-dot"></span>
                          </button>

                          
                           <div class="action_menu action_menu<?php echo $key; ?>">
                        <div class="more-menu-caret">
                            <div class="more-menu-caret-outer"></div>
                            <div class="more-menu-caret-inner"></div>
                        </div>
                        <ul class="more-menu-items" tabindex="-1" role="menu" aria-labelledby="more-btn" aria-hidden="true">
                           <li class="more-menu-item" role="presentation">
                                <a href="<?php base_url();?>view/<?= $subscription['id'];?>"><button type="button" class="more-menu-btn" role="menuitem">View</button></a>
                            </li>
                            <li class="more-menu-item" role="presentation">
                                <a href="<?php base_url();?>account/<?= $subscription['id'];?>"><button type="button" class="more-menu-btn" role="menuitem">Edit</button></a>
                            </li>
                            <li class="more-menu-item" role="presentation">
                                <a href="<?php base_url();?>delete/<?= $subscription['id'];?>"><button type="button" class="more-menu-btn" role="menuitem">Delete</button></a>
                            </li>
                           
                        </ul>
                     </div> 
                          
                        </div>
                         </td>
                    </tr>
                <?php
                    }
                }
                ?>
        </table>
		
			<div class="box-footer text-center">
			<button type="submit" id="role_save" class="btn btn-primary">Save</button>
			</div>
      </form> 
    </div>
  </div>
 </div>
</div>
</div>
</div>

<?= $this->include('templates/footer') ?>
<script>
 
   $('.start_today').datepicker({
    todayHighlight: true,
    format: 'yyyy-mm-dd',
    startDate: new Date()   
    }); 

   $("#form_subscription").validate({
          ignore: [],
          debug: false,
         rules: {
          patient_id: "required",   

      },
      messages: {
          patient_id: "please select patient",
       
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
          error.addClass( "help-block " );
          if ( element.prop( "type" ) === "checkbox" ) {
              error.insertAfter( element.parent( "label" ) );
          } else {
              error.insertAfter( element );
          }
      },

      submitHandler: function () {
 
        var formData = new FormData(form_subscription);

       $.ajax({
           type: 'POST',
           url: "<?php base_url();?>subscription_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
 
                 var data=$.parseJSON(data);
                     if(data.status =="1"){
                         alertify.alert("Successfully!", data.message, function () {
                          window.location.href='<?php echo base_url();?>/customer/license';
                         });
                        
                     }else{
                        alertify.alert("ERROR",data.message, function () { });
                        return false;
                     }   
                    
                 }           
       });

            
      }
  });

function formatDate(date) {
    if (date !== undefined && date !== "") {

      var dt = new Date(date);

year  = dt.getFullYear();
month = (dt.getMonth() + 1).toString().padStart(2, "0");
day   = dt.getDate().toString().padStart(2, "0");

      var str = year+ "-" + month + "-" + day;
      return str;
    }
    return "";
  }

function addMonths(date, months) {
    var d = date.getDate();
    date.setMonth(date.getMonth() + +months);
    if (date.getDate() != d) {
      date.setDate(0);
    }
    return date;
}

 function set_due_date(val){
         var d = new Date(); 
         if(val=='3 Month'){
         var d1=addMonths(new Date(d),3).toString();
         var newdate = Date('')
         console.log(formatDate(d1));
          var str =formatDate(d1);
         $("#end_date").val(str);
         }        
      }

</script>
<?= $this->endSection() ?>
