<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<style type="text/css">
  .fade:not(.show) {
    opacity: 0;
    display: none;
}
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-3 border-bottom pb-2">
       <div class="col-sm-6">
          <h1 class="m-0 text-dark">Customer Onboarding</h1>
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
     <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
     <input type="hidden" name="total_license" id="total_license" value="<?php echo isset($license_count->license)?$license_count->license:0;?>">
     <input type="hidden" name="used_license" id="used_license" value="<?php echo isset($branch_count->license)?$branch_count->license:0;?>">
      <input type="hidden" name="customer_id" id="customer_id" value="<?php echo isset($_SESSION['customer_id'])?$_SESSION['customer_id']:0;?>">
  <div class="col-sm-12">
    <div class="row">
         <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    
            <a class="nav-link active" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills;" aria-selected="true"> <i class="fa fa-user-circle"></i> &nbsp;Account</a>
            <?php if(isset($_SESSION['role_name']) || isset($_SESSION['subscription-management'])){ ?> 
            <a class="nav-link" id="v-pills-subscription-tab" data-toggle="pill" href="#v-pills-subscription" role="tab" aria-controls="v-pills;" aria-selected="true"> <i class="fa fa-calendar-alt"></i> &nbsp;Subscription</a>
            <?php } ?>
            <?php if(isset($_SESSION['role_name']) || isset($_SESSION['license-management'])){ ?> 
            <a class="nav-link" id="v-pills-license-tab" data-toggle="pill" href="#v-pills-license" role="tab" aria-controls="v-pills;" aria-selected="true"><i class="fa fa-wifi"></i> &nbsp;License</a>
            <?php } ?>
            <?php if(isset($_SESSION['role_name'])){ ?> 
            <a class="nav-link" id="v-pills-sms-tab" data-toggle="pill" href="#v-pills-sms" role="tab" aria-controls="v-pills;" aria-selected="true"><i class="fa fa-sms"></i> &nbsp;SMS and Email</a>
            <?php } ?>
            <a class="nav-link" id="v-pills-billing-tab" data-toggle="pill" href="#v-pills-billing" role="tab" aria-controls="v-pills;" aria-selected="true"> <i class="fa fa-file-invoice"></i> &nbsp;Billing details</a>
            <a class="nav-link" id="v-pills-logo-tab" data-toggle="pill" href="#v-pills-logo" role="tab" aria-controls="v-pills;" aria-selected="true"><i class="fa fa-image"></i> &nbsp; Brand logo</a>
       
            <?php if ($id!="") {
                ?> 
            <?php if(isset($_SESSION['role_name']) || isset($_SESSION['user-management'])){ ?>      
            <a class="nav-link" id="v-pills-user_list-tab" data-toggle="pill" href="#v-pills-user_list" role="tab" aria-controls="v-pills;" aria-selected="true"><i class="fa fa-user-friends"></i> &nbsp;Customer users</a>
            <?php } ?>
            <?php if(isset($_SESSION['role_name']) || isset($_SESSION['branch-management'])){ ?>
            <a class="nav-link" id="v-pills-branch-tab" data-toggle="pill" href="#v-pills-branch" role="tab" aria-controls="v-pills;" aria-selected="true"><i class="fa fa-store-alt"></i> &nbsp;Branch/Location</a>
            <?php } ?>

             <?php
            }?>
          </div>

        </div>
    <div class="col-9">

   <div class="tab-pane fade active show" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">

    <div class="card">
    <div class="card-body">
    <form role="form" id="form_cusAccount" name="form_cusAccount" >
    <div class="text-danger" id='role_error' name='role_error'>
    </div>
      
      <div class="box-body">
      <div class="row">
    <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Email Id *</label>
       <?php if ($id=="") {
       ?>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($customer_details->email) ? $customer_details->email : ''; ?>" placeholder="User email id" required> 

     <?php
      }     
      else
      {?>
    <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($customer_details->email) ? $customer_details->email : ''; ?>" placeholder="User email id" disabled> 
     <?php
      }?>
      </div>
      </div>
      </div>
      </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Customer Name *</label>
        <input type="text" class="form-control" name="account_name" id="account_name" value="<?php echo isset($customer_details->account_name) ? $customer_details->account_name : ''; ?>" placeholder="Customer name" required> 
      </div>
      </div>
      </div>
      </div>
   
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Company *</label>
      <input type="text" class="form-control" id="cus_company" name="cus_company" value="<?php echo isset($customer_details->company) ? $customer_details->company : ''; ?>" placeholder="Enter company name" required>
      </div>
    </div><div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Mobile *</label>
      <input type="text" class="form-control" id="cus_mobile" name="cus_mobile" value="<?php echo isset($customer_details->mobile) ? $customer_details->mobile : ''; ?>" placeholder="Enter mobile number" onkeypress="validate(event)" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Contact person *</label>
      <input type="text" class="form-control" id="cus_contact_person" name="cus_contact_person" value="<?php echo isset($customer_details->contact_name) ? $customer_details->contact_name : ''; ?>" placeholder="Enter contact person" required>
      </div>
    </div> 
     <!--  <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Contact number *</label>
      <input type="text" class="form-control" id="cus_company_id" name="cus_company_id" value="<?php echo isset($customer_details->contact_number) ? $customer_details->contact_number : ''; ?>" placeholder="Enter contact number" required>
      </div>
    </div>  -->
    <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Location *</label>
      <input type="text" class="form-control" id="cus_location" name="cus_location" value="<?php echo isset($customer_details->location) ? $customer_details->location : ''; ?>" placeholder="Enter location" required>
      </div>
    </div>
<!--   <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">VAT number</label>
      <input type="text" class="form-control" id="cus_vat_number" name="cus_vat_number" value="<?php echo isset($customer_details->vat_number) ? $customer_details->vat_number : ''; ?>" placeholder="Enter VAT number" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">City</label>
      <input type="text" class="form-control" id="cus_city" name="cus_city" value="<?php echo isset($customer_details->city) ? $customer_details->city : ''; ?>" placeholder="Enter city" required>
      </div>
    </div>
  <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Zip</label>
      <input type="text" class="form-control" id="cus_zip" name="cus_zip" value="<?php echo isset($customer_details->zip) ? $customer_details->zip : ''; ?>" placeholder="Enter zip" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Country</label>
      <input type="text" class="form-control" id="cus_country" name="cus_country" value="<?php echo isset($customer_details->country) ? $customer_details->country : ''; ?>" placeholder="Enter country" required>
      </div>
    </div>
  <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Your business</label>
      <input type="text" class="form-control" id="cus_your_business" name="cus_your_business" value="<?php echo isset($customer_details->your_business) ? $customer_details->your_business : ''; ?>" placeholder="Enter your business" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Your equipment</label>
      <input type="text" class="form-control" id="cus_your_equipment" name="cus_your_equipment" value="<?php echo isset($customer_details->your_equipment) ? $customer_details->your_equipment : ''; ?>" placeholder="Enter your equipment" required>
      </div>
       </div> -->


    </div>
    <?php if ($id=="") {
       ?>
     <div class="row">
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Password *</label>
      <input type="text" class="form-control" id="password" name="password" placeholder="Enter password" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Confirm Password *</label>
      <input type="text" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter confirm password" required>
       </div>
       </div>  
      </div>
      <?php
       }?>
      </div>
      <div class="box-footer text-center">
      <button type="submit" id="role_save" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
    </div>
    
   </div>

   <div class="tab-pane fade" id="v-pills-subscription" role="tabpanel" aria-labelledby="v-pills-subscription-tab">
    <div class="card">
<div class="card-body">
 <form role="form" id="form_subscription" name="form_subscription" >
  <input type="hidden" name="cusSub_id" id="cusSub_id" value="<?php echo $id;?>">
    <div class="text-danger" id='role_error' name='role_error'>
    </div>
  
      <div class="box-body">
      <div class="row">
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Start Date *</label>
      <input type="date" class="form-control" id="start_date" name="start_date" placeholder="" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">End Date *</label>
      <input type="date" class="form-control" id="end_date" name="end_date" placeholder="" required>
      </div>
    </div>
  <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Status</label>
        <?php
          $statusArr = [array("id"=>"1","name"=>"Active"), array("id"=>"2","name"=>"Inactive")];
        ?>
         <select id="status"  class="form-control" placeholder="" name="status">
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

      <div class="box-footer text-center">
      <button type="submit" id="role_save" class="btn btn-primary">Save</button>
      </div>
      </form> 

        
      <?php if ($id!="") {
       ?>
      <!--  <?php if (in_array('add', $action_access)) { ?>
        <div class="table-data__tool-right">
            <div class="col-lg-3 col-sm-4 col-xs-12 ml-auto">
                <a href="#v-pills-subscription" class="mb-0go">
                    <button class="btn btn-primary w-100">
                        <i class="fa fa-plus" aria-hidden="true"></i>Add Subscriptions
                    </button>
                </a>
            </div>
        </div>
         <?php } ?> -->
       <table id="role_datatable" name="role_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
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
                        <td><?= date("d-m-Y", strtotime($subscription['start_date']));?></td>
                        <td><?= date("d-m-Y", strtotime($subscription['end_date']));?></td>
                        <td><?= ($subscription['status']==1)?"Active":"Inactive";?></td>
                        <td style="position: relative;">      
                                   
                         
                        <!-- <a class="blue_text font_16" href="<?php base_url();?>view/<?= $subscription['id'];?>"><i class="fas fa-eye-alt"></i></a>

                         <a class="blue_text font_16" href="<?php base_url();?>/subscription/edit/<?= $subscription['id'];?>"><i class="fas fa-pencil-alt"></i></a> -->
      
                         <a class="blue_text font_16" href="#" onclick="delete_sub('<?= $subscription['id']; ?>');"><i class="fas fa-trash"></i></a>
   
                         </td>
                    </tr>
                <?php
                    }
                }
                ?>
        </table>
        <?php
        }?>
    
     
    </div>
  </div>
   </div>

    <div class="tab-pane fade" id="v-pills-license" role="tabpanel" aria-labelledby="v-pills-license-tab">
    <div class="card">
    <div class="card-body">
     <form role="form" id="form_license" name="form_license" >
      <input type="hidden" name="cusLic_id" id="cusLic_id" value="<?php echo $id;?>">
      <input type="hidden" name="subscription_id" id="subscription_id" value="<?php echo isset($active_sub->id);?>">
        <div class="text-danger" id='role_error' name='role_error'>
        </div>
       
          <div class="box-body">
          <div class="row">
          <div class="col-lg-4 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="rolename">Number of  Hotspot/License *</label>
          <input type="text" class="form-control" id="license" name="license" value="<?php echo isset($license_details->license) ? $license_details->license : ''; ?>" placeholder="Type number of hotspot" required>
          </div>
         </div>
         <div class="col-lg-4 col-sm-6 col-xs-12">
          <div class="form-group">
           <div class="col-xlg-6">
          <div class="form-group">
          <label for="rolename">Status</label>
            <?php
              $statusArr = [array("id"=>"1","name"=>"Active"), array("id"=>"0","name"=>"Inactive")];
            ?>
             <select id="status"  class="form-control"  name="status">
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
          <div class="box-footer text-center">
          <button type="submit" id="role_save" class="btn btn-primary">Save</button>
          </div>
          </form> 

           <?php if ($id!="") {
       ?>
      <!--  <?php if (in_array('add', $action_access)) { ?>
        <div class="table-data__tool-right">
            <div class="col-lg-3 col-sm-4 col-xs-12 ml-auto">
                <a href="#v-pills-subscription" class="mb-0go">
                    <button class="btn btn-primary w-100">
                        <i class="fa fa-plus" aria-hidden="true"></i>Add Subscriptions
                    </button>
                </a>
            </div>
        </div>
         <?php } ?> -->
       <table id="role_datatable_L" name="role_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Location name</th>
                            <th>License</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               <tbody>
                <?php
                if (is_array($branch_details) && count($branch_details) != 0) {
                    foreach ($branch_details as $key=>$branch) {
                ?>
  
                    <tr>
                        <td><?= ++$key;?></td>
                        <td><?= $branch['location_name'];?></td>
                        <td><?= $branch['license'];?></td>
                        <td><?= ($branch['status']==1)?"Active":"Inactive";?></td>
                        <td style="position: relative;">                                    
      
                         <a class="blue_text font_16" href="#" onclick="delete_sub('<?= $branch['id']; ?>');"><i class="fas fa-trash"></i></a>
   
                         </td>
                    </tr>
                <?php
                    }
                }
                ?>
        </table>
        <?php
        }?>

        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="v-pills-sms" role="tabpanel" aria-labelledby="v-pills-sms-tab">
    <div class="card">
    <div class="card-body">
     <form role="form" id="form_sms_email" name="form_sms_email" >
      <input type="hidden" name="cusSms_id" id="cusSms_id" value="<?php echo $id;?>">
        <div class="text-danger" id='role_error' name='role_error'>
        </div>  
        <div class="row">
      <div class="col-lg-4 col-sm-12 col-xs-12">
        <div class="form-group text-left">
           <?php
                        if (isset($customer_details->sms_email_check)) {
                            $active = ($customer_details->sms_email_check == 'Enable') ?  'checked' : '';
                        } else {
                            $active = 'checked';
                        }
                        ?>

          <input id="hide_sms" type="checkbox" name="" value="<?php echo isset($customer_details->sms_email_check) ? $customer_details->sms_email_check : ''; ?>" <?php echo  $active; ?> > Enable/Disable
        </div>
      </div>
     </div>    

          <div class="box-body sms_div">
          <div class="row">
          <div class="col-lg-4 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="rolename">SMS Quota*</label>
          <input type="text" class="form-control" id="cus_sms" name="cus_sms" value="<?php echo isset($customer_details->sms_quota) ? $customer_details->sms_quota : ''; ?>" placeholder="Enter SMS Quota" required>
          </div>
         </div>

         <div class="col-lg-4 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="rolename">Email Quota*</label>
          <input type="text" class="form-control" id="cus_email" name="cus_email" value="<?php echo isset($customer_details->email_quota) ? $customer_details->email_quota : ''; ?>" placeholder="Enter Email Quota" required>
          </div>
         </div>

          </div>
          </div>
  
          <div class="box-footer text-center">
          <button type="submit" id="role_save" class="btn btn-primary">Save</button>
          </div>
          </form> 

        </div>
      </div>
    </div>

     <div class="tab-pane fade" id="v-pills-billing" role="tabpanel" aria-labelledby="v-pills-billing-tab">
      <div class="card">
<div class="card-body">
 <form role="form" id="form_billing" name="form_billing" >
   <input type="hidden" name="cusBill_id" id="cusBill_id" value="<?php echo $id;?>">
    <div class="text-danger" id='role_error' name='role_error'>
    </div>
   
      <div class="box-body">

        <?php if ($id=="") {
       ?>  
      <div class="row">
      <div class="col-lg-4 col-sm-12 col-xs-12">
        <div class="form-group text-left">
            <input id="" type="checkbox" name="" onclick="same_account()"> Same customer account
        </div>
      </div>
     </div>

     <?php
     }?>

      <div class="row">
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Name *</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($billing_details->name) ? $billing_details->name : ''; ?>" placeholder="User name" required> 
      </div>
      </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Company *</label>
      <input type="text" class="form-control" id="company" name="company" value="<?php echo isset($billing_details->company) ? $billing_details->company : ''; ?>" placeholder="Enter company name" required>
      </div>
    </div><div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Mobile *</label>
      <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo isset($billing_details->mobile) ? $billing_details->mobile : ''; ?>" placeholder="Enter mobile number" onkeypress="validate(event)" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Company id *</label>
      <input type="text" class="form-control" id="company_id" name="company_id" value="<?php echo isset($billing_details->company_id) ? $billing_details->company_id : ''; ?>" placeholder="Enter company id" required>
      </div>
    </div> 
  <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">VAT number *</label>
      <input type="text" class="form-control" id="vat_number" name="vat_number" value="<?php echo isset($billing_details->vat_number) ? $billing_details->vat_number : ''; ?>" placeholder="Enter VAT number" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">City *</label>
      <input type="text" class="form-control" id="city" name="city" value="<?php echo isset($billing_details->city) ? $billing_details->city : ''; ?>" placeholder="Enter city" required>
      </div>
    </div>
  <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Zip *</label>
      <input type="text" class="form-control" id="zip" name="zip" value="<?php echo isset($billing_details->zip) ? $billing_details->zip : ''; ?>" placeholder="Enter zip" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Country *</label>
      <input type="text" class="form-control" id="country" name="country" value="<?php echo isset($billing_details->country) ? $billing_details->country : ''; ?>" placeholder="Enter country" required>
      </div>
    </div>
  <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Your business *</label>
      <input type="text" class="form-control" id="your_business" name="your_business" value="<?php echo isset($billing_details->your_business) ? $billing_details->your_business : ''; ?>" placeholder="Enter your business" required>
      </div>
    </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Your equipment *</label>
      <input type="text" class="form-control" id="your_equipment" name="your_equipment" value="<?php echo isset($billing_details->your_equipment) ? $billing_details->your_equipment : ''; ?>" placeholder="Enter your equipment" required>
      </div>
       </div>
     </div>
      </div>    
      <div class="box-footer text-center">
      <button type="submit" id="role_save" class="btn btn-primary">Save</button>
      </div>
      </form> 
    </div>
   </div>
     </div>

      <div class="tab-pane fade" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
        <div class="card">
      <div class="card-body">
       <form role="form" id="form_brandLogo" name="form_brandLogo" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="cusLogo_id" id="cusLogo_id" value="<?php echo $id;?>">
          <div class="text-danger" id='role_error' name='role_error'>
          </div>
         
            <div class="box-body">
            <div class="row">
          <div class="col-lg-8 col-sm-6 col-xs-12">
            <div class="form-group">
             <div class="col-xlg-6">
            <div class="form-group">
            <label for="rolename">Choose an image to upload</label>
             <!--  <input type="file" class="form-control" name="file" required>  -->
           <div class="col-md-4 mb-3">
              <div class="image-upload-wrap">
              <input class="file-upload-input" type='file' name="file" onchange="readURL(this);" accept="image/*" />
              <div class="drag-text">
                 <img alt="img_upload" class="img_upload" id="pat_image"  src="<?php echo isset($brand_details->logo) ? base_url()."/uploads/".$brand_details->logo :base_url()."assets/images/upload_icon.png"; ?>">
                 <h3>Upload Image</h3>
                 <span>Max size 10 mb</span>
              </div>
           </div>
           <div class="file-upload-content">
            <?php $src1=base_url()."assets/images/upload_icon.png";?>
              <img class="file-upload-image" src="<?php echo isset($arr_blog['image']) ? $arr_blog['image'] : $src1 ?>" alt="your image" />
              <div class="image-title-wrap">
                 <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
              </div>
           </div>
          </div>

            </div>
            </div>
            </div>
            </div>

           </div>
          
            </div>
          
            <div class="box-footer text-center">
            <button type="submit" id="role_save" class="btn btn-primary">Save</button>
            </div>
            </form> 
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="v-pills-user_list" role="tabpanel" aria-labelledby="v-pills-user_list-tab">
         <div class="card">
           <?php if (in_array('add', $action_access)) { ?>
           <div class="col-lg-4 col-sm-4 col-xs-12 ml-auto text-lg-right text-sm-right text-center">
          <a class="nav-link mb-0 mb-0go" data-toggle="pill" href="#v-pills-craete_user" role="tab" aria-controls="v-pills;" aria-selected="true"><button class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>Create Customer User</button></a>
         </div>
       <?php } ?>
       <!-- <div class="col-lg-4 col-sm-4 col-xs-12 ml-auto text-lg-right text-sm-right text-center">
          <a class="nav-link mb-0 mb-0go" data-toggle="pill" href="#" role="tab" aria-controls="v-pills;" aria-selected="true"><button class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>Import Customer User</button></a>
         </div> -->
      <div class="card-body">

          <table id="role_datatable_U" name="role_datatable_U" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Customer Name</th>
                            <th>Customer ContactId</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               <tbody>
                <?php
                if (is_array($customer_users) && count($customer_users) != 0) {
                    foreach ($customer_users as $key=>$users) {
                ?>
  
                    <tr>
                        <th><?= ++$key;?></th>
                        <th><?= $users['name'];?></th>
                        <th><?= $users['email'];?></th>
                        <th><?= $users['role'];?></th>
                        <th><?= ($users['status']==1)?"Active":"Inactive";?></th>
                        <th style="position: relative;">                                        

                       <div class="dropdown">
                                <a href="javascript:void(0)" class="services dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-ellipsis-v" data-toggle="dropdown" aria-hidden="true"></i>
                                    <!--<span class="caret"></span>--></a>
                                <ul class="dropdown-menu" role="menu">
                                   <!--  <li class="dropdown-item"><a href="<?php base_url();?>view/<?= $users['id'];?>">View</a></li> -->
                                <li class="dropdown-item"><a onclick="get_user(<?= $users['id'];?>)" >Edit</a></li>
                                     <?php if (in_array('delete', $action_access)) { ?>
                                 <li class="dropdown-item"><a href="#" onclick="delete_cusUser('<?= $users['id']; ?>');">Delete</a></li>
                                       <?php } ?>
                                </ul>
                            </div>
   
                         </th>
                    </tr>
                <?php
                    }
                }
                ?>
        </table>
          </div>
        </div>
      </div>

    <div class="tab-pane fade" id="v-pills-craete_user" role="tabpanel" aria-labelledby="v-pills-craete_user-tab">
    <div class="card">
    <div class="card-body">
    <form role="form" id="form_cusUser" name="form_cusUser" >
      <input type="hidden" name="userId" id="userId">
    <div class="text-danger" id='role_error' name='role_error'>
    </div>
      
      <div class="box-body">
      <div class="row">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">User Name *</label>
   
        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User name" required> 
      </div>
      </div>
      </div>
      </div>
    <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Email Id *</label>
   
        <input type="email" class="form-control" name="user_email" id="user_email" placeholder="User email id" required> 
      </div>
      </div>
      </div>
      </div>
     </div>

      <div class="row user_pass">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Password *</label>
      <input type="text" class="form-control" id="user_password" name="user_password" placeholder="Enter password" required>
      </div>
    </div>
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Confirm Password *</label>
      <input type="text" class="form-control" id="user_confirm_password" name="user_confirm_password" placeholder="Enter confirm password" required>
       </div>
       </div>  
      </div>
      <div class="row">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Role select *</label>
      <select id="role" name="role" class="form-control" required>
          <option value=''> Select Role </option>
          <?php if (is_array($arr_role) && count($arr_role) != 0) {
              foreach ($arr_role as $row) {
          ?>
          <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
          <?php
              }
         } ?>
      </select>
      <!-- <input type="text" class="form-control" id="role" name="role" placeholder="Enter role" required> -->
      </div>
    </div> 
      </div>
      </div>
      <div class="box-footer text-center">
      <button type="submit" id="role_save" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
    </div>
   </div>

   <div class="tab-pane fade" id="v-pills-branch" role="tabpanel" aria-labelledby="v-pills-branch-tab">
         <div class="card">
          <?php if (in_array('add', $action_access)) { ?>
           <div class="col-lg-4 col-sm-4 col-xs-12 ml-auto text-lg-right text-sm-right text-center">
          <a class="nav-link mb-0 mb-0go" data-toggle="pill" href="#v-pills-craete_branch" role="tab" aria-controls="v-pills;" aria-selected="true"><button class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>Create Branch</button></a>
      </div>
        <?php } ?>
      <div class="card-body">

          <table id="role_datatable_B" name="role_datatable_B" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Branch Name</th>
                            <th>Contact Person</th>
                            <th>Contact Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               <tbody>
                <?php
                if (is_array($branch_details) && count($branch_details) != 0) {
                    foreach ($branch_details as $key=>$branch) {
                ?>
  
                    <tr>
                        <th><?= ++$key;?></th>
                        <th><?= $branch['location_name'];?></th>
                        <th><?= $branch['contact_person'];?></th>
                        <th><?= $branch['contact_email'];?></th>
                        <th><?= ($branch['status']==1)?"Active":"Inactive";?></th>
                        <th style="position: relative;">                                        

                        <div class="dropdown">
                                <a href="javascript:void(0)" class="services dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-ellipsis-v" data-toggle="dropdown" aria-hidden="true"></i>
                               </a>
                                <ul class="dropdown-menu" role="menu">
                                  <li class="dropdown-item"><a data-toggle="pill" href="#v-pills-branchUser_list" role="tab" aria-controls="v-pills;" aria-selected="true" onclick="BranchUser_list('<?= $branch['id']; ?>')">User list</a></li>
                                  <li class="dropdown-item"><a onclick="get_branch(<?= $branch['id'];?>)" >Edit</a></li> 
                                 <?php if (in_array('delete', $action_access)) { ?>
                                  <li class="dropdown-item"><a href="#" onclick="delete_branch('<?= $branch['id']; ?>');">Delete</a></li>
                                   <?php } ?>
                                </ul>
                            </div>
   
                         </th>
                    </tr>
                <?php
                    }
                }
                ?>
        </table>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="v-pills-branchUser_list" role="tabpanel" aria-labelledby="v-pills-branchUser_list-tab">
        <div class="card">
           <div class="col-lg-4 col-sm-4 col-xs-12 ml-auto text-lg-right text-sm-right text-center">
          <a class="nav-link mb-0 mb-0go" data-toggle="pill" href="#v-pills-branch_user" role="tab" aria-controls="v-pills;" aria-selected="true"><button class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>Create Branch User</button></a>
      </div>
      <div class="card-body BranchU_List">
    <!--   <table id="role_datatable_B" name="role_datatable_B" class="table table-bordered table-striped BranchU_List">
    
        </table> -->
        </div>
      </div>
   </div>

      <div class="tab-pane fade" id="v-pills-craete_branch" role="tabpanel" aria-labelledby="v-pills-craete_branch-tab">
    <div class="card">
    <div class="card-body">
    <form role="form" id="form_branch" name="form_branch" >
      <input type="hidden" name="branchId" id="branchId">
    <div class="text-danger" id='role_error' name='role_error'>
    </div>     
      <div class="box-body">
      <div class="row">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Location Name *</label>
        <input type="text" class="form-control" name="location_name" id="location_name" value="<?php echo isset($customer_branch->location_name) ? $customer_branch->location_name : ''; ?>" placeholder="Location name" required> 
      </div>
      </div>
      </div>
      </div>
       <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">License</label>
        <input type="text" class="form-control" name="branch_license" id="branch_license" value="<?php echo isset($customer_branch->branch_license) ? $customer_branch->branch_license : ''; ?>" placeholder="Branch license"> 
      </div>
      </div>
      </div>
      </div>
     </div>
      <div class="row">
        <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Contact Person *</label>  
        <input type="text" class="form-control" name="contact_person" id="contact_person" value="<?php echo isset($customer_branch->contact_person) ? $customer_branch->contact_person : ''; ?>" placeholder="Enter contact person" required> 
      </div>
      </div>
      </div>
      </div>
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Contact Email *</label>
      <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?php echo isset($customer_branch->contact_email) ? $customer_branch->contact_email : ''; ?>"  placeholder="Enter contact email" required>
      </div>
     </div>
   </div>
   <div class="row">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Contact Mobile *</label>
      <input type="text" class="form-control" id="contact_mobile" name="contact_mobile" value="<?php echo isset($customer_branch->contact_mobile) ? $customer_branch->contact_mobile : ''; ?>" onkeypress="validate(event)" placeholder="Enter contact mobile" required>
       </div>
       </div>  
     </div>
      </div>
      <div class="box-footer text-center">
      <button type="submit" id="role_save" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
    </div>
   </div>

    <div class="tab-pane fade" id="v-pills-branch_user" role="tabpanel" aria-labelledby="v-pills-branch_user-tab">
    <div class="card">
    <div class="card-body">
    <form role="form" id="form_cusBranchUser" name="form_cusBranchUser" >
      <input type="hidden" name="branch_id" id="branch_id">
       <input type="hidden" name="Branch_userId" id="Branch_userId">
    <div class="text-danger" id='role_error' name='role_error'>
     </div>     
      <div class="box-body">
      <div class="row">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Branch User Name *</label>
        <input type="text" class="form-control" name="brandUser_name" id="brandUser_name" placeholder="Branch user name" required> 
      </div>
      </div>
      </div>
      </div>
    <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Email Id *</label>   
        <input type="email" class="form-control" name="brandUser_email" id="brandUser_email" placeholder="User email id" required> 
      </div>
      </div>
      </div>
      </div>
     </div>
      <div class="row Branch_user_pass">
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Password *</label>
      <input type="text" class="form-control" id="brandUser_password" name="brandUser_password" placeholder="Enter password" required>
      </div>
    </div>
      <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Confirm Password *</label>
      <input type="text" class="form-control" id="brandUser_confirm_password" name="brandUser_confirm_password" placeholder="Enter confirm password" required>
       </div>
       </div>  
      </div>
      <div class="row">
        <div class="col-lg-5 col-sm-6 col-xs-12">
      <div class="form-group">
        <label for="rolename">Role select *</label>
      <select id="branch_role" name="branch_role" class="form-control" required>
          <option value=''> Select Role </option>
          <?php if (is_array($branch_role) && count($branch_role) != 0) {
              foreach ($branch_role as $row) {
          ?>
          <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
          <?php
              }
         } ?>
      </select>
        </div>
       </div>
      </div>

      </div>
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
</div>
</div>
</div>



<?= $this->include('templates/footer') ?>
<script>

  $(document).ready(function () {
        Dtable = $("#role_datatable").DataTable();
        Dtable1 = $("#role_datatable_U").DataTable();
        Dtable2 = $("#role_datatable_B").DataTable();
        Dtable3 = $("#role_datatable_L").DataTable();
    });

  $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });

   $( document ).ready(function() {
       var id="<?php echo $id ?>";
       console.log("id="+id);
         if(id==''){
          //  $('#v-pills-subscription-tab').attr('disabled','disabled');
            $('#v-pills-subscription-tab').prop('disabled', true)
            $('#v-pills-license-tab').prop('disabled',true);
            $('#v-pills-billing-tab').prop('disabled',true);
            $('#v-pills-logo-tab').prop('disabled',true);
            $('#v-pills-sms-tab').prop('disabled',true);
           

         }

         if($('#hide_sms:checked').length){
               $('.sms_div').show();                
            }else{
                $('.sms_div').hide();
            }
            
      });

  function readURL(input) {
         if (input.files && input.files[0]) {
         
          var reader = new FileReader();
         
          reader.onload = function(e) {
            $('.image-upload-wrap').hide();
         
            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();
         
            $('.image-title').html(input.files[0].name);
          };
         
          reader.readAsDataURL(input.files[0]);
         
         } else {
          removeUpload();
         }
         }

         function removeUpload() {
         $('.file-upload-input').replaceWith($('.file-upload-input').clone());
         $('.file-upload-content').hide();
         $('.image-upload-wrap').show();
         }
         $('.image-upload-wrap').bind('dragover', function () {
         $('.image-upload-wrap').addClass('image-dropping');
         });
         $('.image-upload-wrap').bind('dragleave', function () {
         $('.image-upload-wrap').removeClass('image-dropping');
         });

         function validate(evt) {
             var theEvent = evt || window.event;

             // Handle paste
             if (theEvent.type === 'paste') {
                 key = event.clipboardData.getData('text/plain');
             } else {
             // Handle key press
                 var key = theEvent.keyCode || theEvent.which;
                 key = String.fromCharCode(key);
             }
             var regex = /[0-9]|\./;
             if( !regex.test(key) ) {
               theEvent.returnValue = false;
               if(theEvent.preventDefault) theEvent.preventDefault();
             }
           }

      function delete_sub(sub_id) {
        if (sub_id != 0) {
            var params = [];
            params.push({
                'name': 'id',
                'value': sub_id
            });
            var action_url = BASE_URL + "subscription/delete";
            delete_confirmation_message(params, action_url);

        }
    }

    function delete_cusUser(user_id) {
        if (user_id != 0) {
            var params = [];
            params.push({
                'name': 'id',
                'value': user_id
            });
            var action_url = BASE_URL + "customer/user_delete";
            delete_confirmation_message(params, action_url);

        }
    }

     function delete_branch(branch_id) {
        if (branch_id != 0) {
            var params = [];
            params.push({
                'name': 'id',
                'value': branch_id
            });
            var action_url = BASE_URL + "customer/branch_delete";
            delete_confirmation_message(params, action_url);

        }
    }

    function delete_branch_User(user_id) {
        if (user_id != 0) {
            var params = [];
            params.push({
                'name': 'id',
                'value': user_id
            });
            var action_url = BASE_URL + "customer/branchUser_delete";
            delete_confirmation_message(params, action_url);

        }
    }

    function BranchUser_list(branch_id)
    {
       $('#branch_id').val(branch_id);
      $.ajax({
           type: 'POST',
           url: BASE_URL+"Customer/branchUser_list",
           data: {branch_id:branch_id},
           success: function (data) {

               $(".BranchU_List").html(data);  
                
             }           
       });
    }

    function same_account()
    {
       var cus_company= $('#cus_company').val();
       var cus_mobile= $('#cus_mobile').val();
       var cus_company_id= $('#cus_company_id').val();
       var cus_vat_number= $('#cus_vat_number').val();
       var cus_city= $('#cus_city').val();
       var cus_zip= $('#cus_zip').val();
       var cus_country= $('#cus_country').val();
       var cus_your_business= $('#cus_your_business').val();
       var cus_your_equipment= $('#cus_your_equipment').val();
       $('#company').val(cus_company);
       $('#mobile').val(cus_mobile);
       $('#company_id').val(cus_company_id);
       $('#vat_number').val(cus_vat_number);
       $('#city').val(cus_city);
       $('#zip').val(cus_zip);
       $('#country').val(cus_country);
       $('#your_business').val(cus_your_business);
       $('#your_equipment').val(cus_your_equipment);

    }
    $("#hide_sms" ).click(function() {
        if($('#hide_sms:checked').length){
               $('.sms_div').show();                
            }else{
                $('.sms_div').hide();
            }
      });
    function hide_sms()
    {

       $('.sms_div').hide();
 

    }
 
     $('.start_today').datepicker({
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      startDate: new Date()   
      }); 

   $("#form_cusAccount").validate({
          ignore: [],
          debug: false,
         rules: {
          account_name: "required",
          email: "required",
           password: {required : true,
            minlength : 8 ,
            alphanumeric: true,

            },
         confirm_password: {
            required : true,
            equalTo: "#password"
         },
   

      },
      messages: {
          account_name: "please enter accout name",
          email: "please enter email",
              password: {required : "please enter your password",
            minLength : "Minimum 8 characters",
            alphanumeric : "Letters, numbers, and underscores only please"
            },
         confirm_password : { required : "please enter your confirm password", 
                     equalTo: "Enter Confirm Password Same as Password"
                      },

  
        
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block " );
          if ( element.prop( "type" ) === "checkbox" ) {
              error.insertAfter( element.parent( "label" ) );
          } else {
              error.insertAfter( element );
          }
      },

      submitHandler: function () {
 
        var formData = new FormData(form_cusAccount);
        formData.append('id', $('#id').val());
        var id =$('#id').val();

       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/account_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
            $('#v-pills-account-tab').prop('disabled', true)
            $('#v-pills-subscription-tab').prop('disabled', false)

             var data=$.parseJSON(data);
                 if(data.status =="1"){
                  if (id=="") {
                   $('#cusSub_id').val(data.id);
                   $('#cusBill_id').val(data.id);
                   $('#cusLogo_id').val(data.id);
                   $('#cusLic_id').val(data.id);
                   $('#cusSms_id').val(data.id);
                      success_message('Customer account Successfully');
                      $('#v-pills-account').removeClass('active');
                      $('#v-pills-account-tab').removeClass('active');
                      $('#v-pills-account').removeClass('show');
                      $('#v-pills-subscription').addClass('active');
                      $('#v-pills-subscription').addClass('show');
                      $('#v-pills-subscription-tab').addClass('active');
                    }

                      else{
                           success_message('Customer account Successfully');
                           window.location.href=BASE_URL+'customer/account/'+id;
                        }
                    
                 }
                    else if(data.status =="2")
                    {
                        error_message('Email already exist!');
                    }
                 else{
                     error_message('Failed');
                    return false;
                 }   
                
             }           
       });

            
      }
  });

   jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

   $("#form_cusUser").validate({
          ignore: [],
          debug: false,
         rules: {
          user_name: "required",
          user_email: "required",
           user_password: {required : true,
            minlength : 8 ,
            alphanumeric: true,

            },
         confirm_password: {
            required : true,
            equalTo: "#password"
         },
   

      },
      messages: {
          user_name: "please enter user name",
          user_email: "please enter email",
              user_password: {required : "please enter your password",
            minLength : "Minimum 8 characters",
            alphanumeric : "Accepts only alphanumberic values and underscores"
            },
         user_confirm_password : { required : "please enter your confirm password", 
                     equalTo: "Password and confirm password does not match"
                      },

  
        
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block " );
          if ( element.prop( "type" ) === "checkbox" ) {
              error.insertAfter( element.parent( "label" ) );
          } else {
              error.insertAfter( element );
          }
      },

      submitHandler: function () {
 
        var formData = new FormData(form_cusUser);
        formData.append('id', $('#id').val());
        var id =$('#id').val();
        $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/user_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {

             var data=$.parseJSON(data);
                 if(data.status =="1"){
       
                      success_message('Customer user added Successfully');
                      window.location.href=BASE_URL+'customer/account/'+id;
                  
                    
                 }
                 else if(data.status =="2")
                    {
                        error_message('Email already exist!');
                    }
                 else{
                     error_message('Failed');
                    return false;
                 }   
                
             }           
       });

            
      }
  });


   $("#form_billing").validate({
          ignore: [],
          debug: false,
         rules: {
          name: "required",
          company: "required",
           mobile: {
                digits: true,
                max:10,
                min: 1
            },
          mobile: "required",

   

      },
      messages: {
          name: "please enter name",
          company: "please enter company",
          mobile: "please enter mobile",
        
      },
      errorElement: "em",
      submitHandler: function () {
        var formData = new FormData(form_billing);
        formData.append('id', $('#id').val());
        var id = $('#id').val();
   
       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/billing_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
            if (id=='') {
              $('#v-pills-billing-tab').prop('disabled',true);
              $('#v-pills-logo-tab').prop('disabled',false);
            }
        
             var data=$.parseJSON(data);
                 if(data.status =="1"){
                   success_message('Billing details Successfully');
                      $('#v-pills-billing').removeClass('active');
                      $('#v-pills-billing-tab').removeClass('active');
                      $('#v-pills-billing').removeClass('show');
                      $('#v-pills-logo').addClass('active');
                      $('#v-pills-logo').addClass('show');
                      $('#v-pills-logo-tab').addClass('active');
           
                   
                 }else{
                     error_message('Failed');
                    return false;
                 }   
                  }
          
         });
            
      }
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
        var id = $('#id').val();
        var formData = new FormData(form_subscription);
        formData.append('id', $('#id').val());
       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/subscription_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
            if (id=="") {
              $('#v-pills-subscription-tab').prop('disabled', true)
              $('#v-pills-license-tab').prop('disabled',false);
   
            }
          
                 var data=$.parseJSON(data);
                     if(data.status =="1"){
                      if (id=="") {
                         success_message('Customer Subscription Successfully');
                          $('#v-pills-subscription').removeClass('active');
                          $('#v-pills-subscription-tab').removeClass('active');
                          $('#v-pills-subscription').removeClass('show');
                          $('#v-pills-license').addClass('active');
                          $('#v-pills-license').addClass('show');
                          $('#v-pills-license-tab').addClass('active');
                        }
                        else{
                           success_message('Customer Subscription Successfully');
                           window.location.href=BASE_URL+'customer/account/'+id;
                        }
           
                        
                     }else{
                         error_message('Failed');
                        return false;
                     }   
                    
                 }           
       });

            
      }
  });

   $("#form_brandLogo").validate({
          ignore: [],
          debug: false,
         rules: {
          email: "required",
          password: "required",
          confirm_password: "required",
   

      },
      messages: {
          email: "please enter email",
          password: "please enter password",
          confirm_password: "please enter confirm password",

  
        
      },
      errorElement: "em",

      submitHandler: function () {
 
        var formData = new FormData(form_brandLogo);
        formData.append('id', $('#id').val());
       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/brand_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
 
                 var data=$.parseJSON(data);
                     if(data.status =="1"){
                           success_message('Brand logo Successfully');
                          window.location.href= BASE_URL+'customer/list';
          
                        
                     }else{
                          error_message('Failed');
                        return false;
                     }   
                    
                 }           
       });

            
      }
  });

    $("#form_license").validate({
          ignore: [],
          debug: false,
         rules: {
          license: "required",   

      },
      messages: {
          license: "please enter no of hotspot",
       
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
         var id = $('#id').val();
        //  var license_count ='<?php isset($license_count->license);?>';
         var customer_id = $('#customer_id').val();
         var license=$('#license').val();
         var license_count = $('#total_license').val();
         if(customer_id==0 || license_count<license){

         if (id=="") {
           $('#v-pills-license-tab').prop('disabled',true);
           $('#v-pills-billing-tab').prop('disabled',false);
         }
       

        var formData = new FormData(form_license);
        formData.append('id', $('#id').val());

        var id = $('#id').val();
       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/license_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
 
                 var data=$.parseJSON(data);
                     if(data.status =="1"){
                       success_message('License Successfully');
                          $('#v-pills-license').removeClass('active');
                          $('#v-pills-license-tab').removeClass('active');
                          $('#v-pills-license').removeClass('show');
                          $('#v-pills-sms').addClass('active');
                          $('#v-pills-sms').addClass('show');
                          $('#v-pills-sms-tab').addClass('active');                     
                        
                     }else{
                        error_message('Failed');
                        return false;
                     }   
                    
                 }           
       });
     }else
     {
       error_message('Limited license ! please enter less then license');
     }

            
      }
  });

    $("#form_sms_email").validate({
          ignore: [],
          debug: false,
         rules: {
           cus_sms: "required",
           cus_email: "required",   
      },
      messages: {
          cus_sms: "please enter SMS Quota",
          cus_email: "please enter Email Quota",
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
         var id = $('#id').val();
         var customer_id = $('#customer_id').val();


       
        var formData = new FormData;

        if($('#hide_sms:checked').length){
              var cus_sms = $('#cus_sms').val();
              var cus_email = $('#cus_email').val(); 
              var sms_email_check='Yes';             
            }else{
              var cus_sms = 0;
              var cus_email =0; 
              var sms_email_check='No';
            }
        formData.append('id', $('#cusSms_id').val());
        // formData.append('id', $('#id').val());
        formData.append('cus_sms',cus_sms);
        formData.append('cus_email',cus_email);
        formData.append('sms_email_check', sms_email_check);

        var id = $('#id').val();
       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/sms_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
 
                 var data=$.parseJSON(data);
                     if(data.status =="1"){
                       success_message('Sms and Email Quotas saved successfully!');
                          $('#v-pills-sms').removeClass('active');
                          $('#v-pills-sms-tab').removeClass('active');
                          $('#v-pills-sms').removeClass('show');
                          $('#v-pills-billing').addClass('active');
                          $('#v-pills-billing').addClass('show');
                          $('#v-pills-billing-tab').addClass('active');                     
                        
                     }else{
                        error_message('Failed');
                        return false;
                     }   
                    
                 }           
       });
     
            
      }
  });

     $("#form_change_pass").validate({
          ignore: [],
          debug: false,
         rules: {     
           change_password: {required : true,
            minlength : 8 ,
            },
      },
      messages: {

           change_password: {required : "please enter your passsword",
            minLength : "Minimum 8 characters",
            },
                 
      },
      errorElement: "em",

      submitHandler: function () {
 
        var formData = new FormData(form_change_pass);
        formData.append('id', $('#id').val());
       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/change_password",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
 
                 var data=$.parseJSON(data);
                     if(data.status =="1"){
                       $('#id').val(data.id);
                        success_message('Password changed Successfully');
                          $('#v-pills-account').removeClass('active');
                          $('#v-pills-account-tab').removeClass('active');
                          $('#v-pills-account').removeClass('show');
                          $('#v-pills-subscription').addClass('active');
                          $('#v-pills-subscription').addClass('show');
                          $('#v-pills-subscription-tab').addClass('active');
           
                        
                     }else{
                         error_message('Failed');
                        return false;
                     }   
                    
                 }           
       });

            
      }
  });  

  $("#form_branch").validate({
          ignore: [],
          debug: false,
         rules: {
          location_name: "required",
          contact_person: "required",
          contact_mobile: "required",
          contact_email: "required",
   

      },
      messages: {
          location_name: "please enter location",
          contact_person: "please enter cotact person",
          contact_mobile: "please enter mobile",
          contact_email: "please enter email",
        
      },
      errorElement: "em",
      submitHandler: function () { 
        var formData = new FormData(form_branch);
        formData.append('id', $('#id').val());
        var id =$('#id').val();
        var license_count = $('#total_license').val();
        var branch_license = $('#used_license').val();
        // var branch_license =parseInt('<?php echo $branch_count->license;?>');
        var license_= $('#branch_license').val();
        var total_license =parseInt(branch_license)+parseInt(license_);
        // var license_count ='<?php echo isset($license_count->license);?>';
        if (total_license < license_count) {
        $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/branch_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
             var data=$.parseJSON(data);
                 if(data.status =="1"){
                      success_message('Customer Branch Added Successfully');
                      window.location.href=BASE_URL+'customer/account/'+id;
                 }else{
                     error_message('Failed');
                    return false;
                 }   
                
             }           
       });
    }else{
         error_message('In-sufficient hotspots. Only '+(license_count - branch_license)+' available for use!');
    }
            
      }
  });

  $("#form_cusBranchUser").validate({
          ignore: [],
          debug: false,
         rules: {
          brandUser_email: "required",
           brandUser_password: {required : true,
            minlength : 8 ,
            alphanumeric: true,

            },
         brandUser_confirm_password: {
            required : true,
            equalTo: "#brandUser_password"
         },
   

      },
      messages: {
          brandUser_email: "please enter email",
              brandUser_password: {required : "please enter your passsword",
            minLength : "Minimum 8 characters",
            alphanumeric : "Letters, numbers, and underscores only please"
            },
         brandUser_confirm_password : { required : "please enter your confirm passsword", 
                     equalTo: "Enter Confirm Password Same as Password"
                      },

  
        
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block " );
          if ( element.prop( "type" ) === "checkbox" ) {
              error.insertAfter( element.parent( "label" ) );
          } else {
              error.insertAfter( element );
          }
      },

      submitHandler: function () {
 
        var formData = new FormData(form_cusBranchUser);
        formData.append('id', $('#id').val());
        var id = $('#id').val();
       $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/branchUser_save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {

             var data=$.parseJSON(data);
                 if(data.status =="1"){
                   $('#cusSub_id').val(data.id);
                   $('#cusBill_id').val(data.id);
                   $('#cusLogo_id').val(data.id);
                   $('#cusLic_id').val(data.id);
                      success_message('Customer branch user Successfully');
                       window.location.href=BASE_URL+'customer/account/'+id;
                    
                 }
                 else if(data.status =="2")
                    {
                        error_message('Email already exist!');
                    }
                 else{
                     error_message('Failed');
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

      function get_branch(branch_id)
      {

         $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/single_branch",
           data: {branch_id:branch_id},
           success: function (data) {
             var data=$.parseJSON(data);
                 if(data.status =="1"){   
                   $('#location_name').val(data.location_name);
                   $('#contact_person').val(data.contact_person);
                   $('#contact_mobile').val(data.contact_mobile);
                   $('#contact_email').val(data.contact_email);
                   $('#branch_license').val(data.license);
                    $('#branchId').val(data.id);

                    $('#v-pills-branch').removeClass('active');
                    $('#v-pills-branch').removeClass('show');

                   $('#v-pills-craete_branch').addClass('show');
                   $('#v-pills-craete_branch').addClass('active');

                 }else{
                     error_message('Failed');
                    return false;
                 }   
                
             }           
       });
      }

      function get_user(user_id)
      {
        $('#user_password').attr("disabled","disabled"); 
        $('#user_confirm_password').attr("disabled","disabled");
        $('.user_pass').hide();
       
         $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/single_user",
           data: {user_id:user_id},
           success: function (data) {
             var data=$.parseJSON(data);
                 if(data.status =="1"){   
                   $('#user_name').val(data.name);
                   $('#user_email').val(data.email);
                   $("#user_email").prop('disabled', true);
                   $('#userId').val(data.id);
                   //$('#roleId').val(data.role_id);
                    $('#role option[value="'+data.role_id+'"]').prop('selected', true);

                   $('#v-pills-user_list').removeClass('active');
                   $('#v-pills-user_list').removeClass('show');

                   $('#v-pills-craete_user').addClass('show');
                   $('#v-pills-craete_user').addClass('active');

                 }else{
                     error_message('Failed');
                    return false;
                 }   
                
             }           
       });
      }

       function get_Branchuser(user_id)
      {
        $('#brandUser_password').attr("disabled","disabled"); 
        $('#brandUser_confirm_password').attr("disabled","disabled");
        $('.Branch_user_pass').hide();
       
         $.ajax({
           type: 'POST',
           url: BASE_URL+"customer/single_user",
           data: {user_id:user_id},
           success: function (data) {
             var data=$.parseJSON(data);
                 if(data.status =="1"){   
                   $('#brandUser_name').val(data.name);
                   $('#brandUser_email').val(data.email);
                   $("#brandUser_email").prop('disabled', true);
                   $('#Branch_userId').val(data.id);

                    $('#branch_role option[value="'+data.role_id+'"]').prop('selected', true);

                   $('#v-pills-branchUser_list').removeClass('active');
                   $('#v-pills-branchUser_list').removeClass('show');

                   $('#v-pills-branch_user').addClass('show');
                   $('#v-pills-branch_user').addClass('active');

                 }else{
                     error_message('Failed');
                    return false;
                 }   
                
             }           
       });
      }

</script>
<?= $this->endSection() ?>
