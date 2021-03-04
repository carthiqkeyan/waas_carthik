<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>


<!-- //------------------------------------------------------------// -->
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-3 border-bottom pb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Report Management </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Report Management </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <!--<p data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	<i class="fa fa-chevron-up" aria-hidden="true"></i>
	</p>-->
    <div class="card card-body mb-3">
     <div class="row top_box">
		<div class="col-lg-11 col-sm-10 col-12">
		<div class="row">
		<div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
		<div class="row">
		<!-- <div class="col-lg-8 col-sm-8 col-8 p-0">
		<div class="form-group">

		<input type="text" class="form-control border_left_0" placeholder="Type brand name">
		</div>
		</div> -->
		<div class="col-lg-12 col-sm-12 col-12">
		<div class="form-group">
	
		<select class="form-control border_right_0 get_account" id="account_id" name="account_id">
      <option value="">--select--</option>
			<?php foreach ($account_list as $value) {
      ?>
		<option value="<?php echo $value['id'];?>"><?php echo $value['account_name']; ?></option>
            <?php } ?>
		</select>
		</div>
		</div>
		</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
		<div class="row">
	<!-- 	<div class="col-lg-8 col-sm-8 col-8 p-0">
		<div class="form-group">

		<input type="text" class="form-control border_left_0" placeholder="Type account name">
		</div>
		</div> -->
		<div class="col-lg-12 col-sm-12 col-12">
		<div class="form-group">
<!-- 
		<select class="form-control border_right_0">
		<?php foreach ($branch_details as $value) {
    ?>
		<option><?php echo $value['location_name']; ?></option>
            <?php } ?>
		</select> -->
    <select name="branch_details" id="branch_details" class="form-control border_right_0 branch_details" title="UOM" >
      <option value="">--select--</option>
    </select>

		</div>
		</div>
		</div>
		</div>
		<!-- <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
		<div class="row">
		<div class="col-lg-8 col-sm-8 col-8 p-0">
		<div class="form-group">

		<input type="text" class="form-control border_left_0" placeholder="Last 15 days">
		</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-4 p-0">
		<div class="form-group">

		<input type="date" class="form-control float-right border_right_0" id="reservation">
		</div>
		</div>
		</div>
		</div> -->
		</div>
		</div>
	 	<!-- <div class="col-lg-1 col-sm-2 col-12">
		<div class="row">
		<div class="col-lg-8 col-sm-8 col-8 p-0">
		<div class="form-group">

		<input type="text" class="form-control border_left_0" placeholder="File">
		</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-4 p-0">
		<div class="form-group">

		<input type="date" class="form-control float-right border_right_0" id="reservation">
		</div>
		</div>
		</div>
		</div>  -->
		</div> 

    <div class="table-data__tool-right  text-lg-right text-sm-right text-center">
        <div class="col-lg-3 col-sm-4 col-xs-12 ml-auto">
            <a href="<?php base_url(); ?>report/download_csv/<?php echo $customer_id;?>" class="mb-0 mb-0go">
                <button class="btn btn-primary">
                    <i class="fa fa-plus" aria-hidden="true"></i>Download CSV
                </button>
            </a>
        </div>
    </div>

      <?php $i = 0;
      foreach ($arr_customer as $value) {
        $i++;
        if ($i > 2) {
      ?>
          <div class="collapse collapse_multi" id="collapseContent">

          <?php } else { ?>
            <div class="collapse_multi">
            <?php } ?>
            <h6>Customer/Account : <?php echo $value['customer_name']; ?> </h6>
            <div class="row">
              <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                <div class="grid_box_mobility">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h1><?php echo $value['branch_count']; ?></h1>
                      <p class="">Total Branches</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 border-left">
                      <h1 class="orange"><?php echo $value['branch_month']; ?></h1>
                      <p class="">New Branches</p>
                    </div>
                  </div>
                </div>
                <div class="grid_box_footer">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h3>Branches</h3>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <a href="<?php base_url(); ?>report/view_details/<?php echo $value['customer_id']; ?>">View details</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                <div class="grid_box_mobility">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h1><?php echo $value['brand_count']; ?></h1>
                      <p class="">Total Hotspots</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 border-left">
                      <h1 class="orange"><?php echo $value['brand_month']; ?></h1>
                      <p class="">New Hotspots</p>
                    </div>
                  </div>
                </div>
                <div class="grid_box_footer">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h3>Hotspots</h3>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <a href="<?php base_url(); ?>report/view_details/<?php echo $value['customer_id']; ?>">View details</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                <div class="grid_box_mobility">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <!-- <h1><?php echo $value['user_count']; ?></h1> -->
                      <h1>0</h1>
                      <p class="">Total Users</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 border-left">
                      <!-- <h1 class="orange"><?php echo $value['user_count']; ?></h1> -->
                      <h1 class="orange">0</h1>
                      <p class="">New Users</p>
                    </div>
                  </div>
                </div>
                <div class="grid_box_footer">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h3>Users</h3>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <a href="<?php base_url(); ?>report/view_details/<?php echo $value['customer_id']; ?>">View details</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>

          <?php
        }
          ?>
         <div class=" " id="collapseContent_filter"></div>
          
         <a class="grid_arrow_up_down collapsed" data-toggle="collapse" href="#collapseContent" role="button" aria-expanded="false" aria-controls="collapseContent">
            <span class="if-collapsed"><b><i class="fa fa-angle-up" aria-hidden="true"></i></b></span>
            <span class="if-not-collapsed"><b><i class="fa fa-angle-down" aria-hidden="true"></i>
              </b></span>
          </a>

          </div>
         

          <!-- <div class="card card-body">
         <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="card">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">

                        Hotspots
                     </h3>
                  </div>
                  <div class="card-body">
                     <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="card">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">
 
                        Device Specification
                     </h3>
                  </div>
                  <div class="card-body">
                     <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                     </div>
    
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="card">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">

                        Gender Specification
                     </h3>
          
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-6 col-lg-4 text-center">
                           <input type="text" class="knob" value="50" data-width="120" data-height="120" data-fgColor="#3c8dbc"
                              data-readonly="true">
                           <div class="knob-label">Male</div>
                        </div>
                        <div class="col-6 col-lg-4 text-center">
                           <input type="text" class="knob" value="30" data-width="120" data-height="120" data-fgColor="#ec9121"
                              data-readonly="true">
                           <div class="knob-label">Female</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			<div class="col-lg-6 col-sm-6 col-12">
               <div class="card h_241">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">
 
                        Age Specification
                     </h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-12 col-lg-12">
						<div class="sparkline" data-type="line" data-spot-Radius="3" data-highlight-Spot-Color="#f39c12" data-highlight-Line-Color="#222" data-min-Spot-Color="#f56954" data-max-Spot-Color="#00a65a" data-spot-Color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-Width="2" data-line-Color="#39CCCC" data-fill-Color="rgba(57, 204, 204, 0.08)">
                        6,4,7,8,4,3,2,2,5,6,7,4,1,5,7,9,9,8,7,6
                     </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-12">

               <div class="card card-info">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">

                        Dwell Time
                     </h3>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <canvas id="myChart4"></canvas>
                     </div>
                  </div>

               </div>

            </div>

            
         </div>
      </div> -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->


<?= $this->include('templates/footer') ?>
<!-- <script src="<?= base_url() ?>/dist/js/pages/dashboard3.js"></script>

<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/chart.js/Chart.min.js"></script>

<script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/adminlte.min.js"></script>

<script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/demo.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script> -->
<script>
  function get_account(customer_id)
 {
   var customer_id = customer_id;
   $.ajax({
          type: 'POST',
          url: BASE_URL+"report/get_customer",
          data: {customer_id:customer_id},

          success: function (data) {
            var data=$.parseJSON(data);
            alert('hi');
          
          }
      });
 }

 $(document).on('change','.get_account',function(e){
  var customer_id=$('#account_id').val();
   var html = ''; 
    $.ajax({
       type:'POST',
       url: BASE_URL+"report/get_customer",
       data:{customer_id:customer_id},
       async:false,
       cache:false,
       success: function(data)
       { 
        var tempdata=$.trim(data);
        var temp = $.parseJSON(tempdata);
        var branch=temp.arr_customer;
        var $el = $('#branch_details');
        console.log(branch[0].branch_list);
        var prevValue = $el.val();
         
        $el.empty();
         
            $el.append('<option value="">--select--</option>');
            $.each(branch[0].branch_list, function(key, value) {
          
              $el.append($('<option></option>').attr('value', value.id).text(value.location_name));
            
            });
            $(".collapse_multi").hide();

            $("#collapseContent_filter").html(temp.data_view);

      }
      }); 
 });

 $(document).on('change','.branch_details',function(e){
  var branch_id=$('#branch_details').val();
  var customer_id=$('#account_id').val();
   var html = ''; 
    $.ajax({
       type:'POST',
       url: BASE_URL+"report/get_branch",
       data:{branch_id:branch_id,customer_id:customer_id},
       async:false,
       cache:false,
       success: function(data)
       { 
        var tempdata=$.trim(data);
        var temp = $.parseJSON(tempdata);
        var branch=temp.arr_customer;
     $("#total_hotspot").html(branch[0].brand_count);
     $("#new_hotspot").html(branch[0].brand_month);
     $(".link_url").removeAttr("href");
     $(".link_url").attr("href", "<?php base_url(); ?>report/view_details/"+customer_id+"/"+branch_id);
     //href="<?php base_url(); ?>report/view_details/<?php //echo $arr['customer_id']; ?>"
      }
      }); 
 });

</script>

<?= $this->endSection() ?>