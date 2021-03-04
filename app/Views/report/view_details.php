
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
<input type="hidden" name="account_id" id="account_id" value="<?php echo $customer_id;?>">
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
	<!-- Small boxes (Stat box) -->
	<!--<p data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	<i class="fa fa-chevron-up" aria-hidden="true"></i>
	</p>-->
	<div class="card card-body mb-3">
		<div class="row top_box">
		<div class="col-lg-4 col-sm-10 col-12">
		<div class="row">

		<div class="col-lg-12 col-sm-12 col-12 p-0">
		<div class="form-group">
	    <select name="branch_details" id="branch_details" class="form-control border_right_0 branch_details" title="UOM" >
	      <option value="">--select--</option>
         <?php $selected='';
         if (!empty($branch_details)) {
          foreach ($branch_details as $value) {
         	if($branch_id!='' &&  $value['id']==$branch_id){
         		$selected='selected';
         	}
          ?>
		<option value="<?php echo isset($value['id']);?>" <?php echo $selected; ?> ><?php echo $value['location_name']; ?></option>
            <?php }
            } ?>
		</select>

		</div>
		</div>

		</div>
		</div>

		</div>

     <?php 
     foreach ($arr_customer as $value) {
     ?>
       <h2><?php echo $value['customer_name'];?></h2>
		<div class="row">
		<div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
		<div class="grid_box_mobility">
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
		<h1><?php echo $value['branch_count'];?></h1>
		<p class="">Total Branch</p>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-12 border-left">
		<h1 class="orange"><?php echo $value['branch_month'];?></h1>
		<p class="">New Branch</p>
		</div>
		</div>
		</div>
		<div class="grid_box_footer">
		 <div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
		<h3>Branch</h3>
		</div>
	
		</div>
		</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
		<div class="grid_box_mobility">
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
		<h1 id="total_hotspot"><?php echo $value['brand_count'];?></h1>
		<p class="">Total Hotspot</p>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-12 border-left">
		<h1 id="new_hotspot" class="orange"><?php echo $value['brand_month'];?></h1>
		<p class="">New Hotspot</p>
		</div>
		</div>
		</div>
		<div class="grid_box_footer">
		 <div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
		<h3>Hotspot</h3>
		</div>

		</div>
		</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
		<div class="grid_box_mobility">
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
		<!-- <h1><?php echo $value['user_count'];?></h1> -->
		<h1>0</h1>
		<p class="">Total Users</p>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-12 border-left">
		<!-- <h1 class="orange"><?php echo $value['user_count'];?></h1> -->
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
		</div>
		</div>
		</div>
	  </div>

	  <?php
	  }
	?>
		
	</div>
	<div class="card card-body">
         <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="card">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">
                        <!--<i class="far fa-chart-bar"></i>-->
                        Hotspots
                     </h3>
                     <!--<div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                           class="fas fa-minus"></i>
                        </button>
                         <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                           </button>
                     </div>-->
                  </div>
                  <div class="card-body">
                     <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                     </div>
                     <!--<div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Total Users
                        </span>
                        <span>
                        <i class="fas fa-square text-gray"></i> New Users
                        </span>
                     </div>-->
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="card">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">
                        <!--<i class="far fa-chart-bar"></i>-->
                        Device Specification
                     </h3>
                     <!--<div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                        </div>-->
                  </div>
                  <div class="card-body">
                     <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                     </div>
                     <!--<div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <i class="fas fa-square text-primary"></i> This year
                        </span>
                        
                        <span>
                          <i class="fas fa-square text-gray"></i> Last year
                        </span>
                        </div>-->
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="card">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">
                        <!--<i class="far fa-chart-bar"></i>-->
                        Gender Specification
                     </h3>
                     <!--<div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                        </div>-->
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
                        <!--<i class="far fa-chart-bar"></i>-->
                        Age Specification
                     </h3>
                     <!--<div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                        </div>-->
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
               <!-- LINE CHART -->
               <div class="card card-info">
                  <!--<div class="card-header">
                     <h3 class="card-title">Line Chart</h3>
                     
                     <div class="card-tools">
                       <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                       </button>
                       <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                     </div>
                     </div>-->
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">
                        <!--<i class="far fa-chart-bar"></i>-->
                        Dwell Time
                     </h3>
                     <!--<div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                        </div>-->
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <!--<canvas id="lineChart" style="height:250px; min-height:250px"></canvas>-->
                        <canvas id="myChart4"></canvas>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!--<div class="col-lg-4 col-sm-6 col-12">
               <div class="box box-solid">
                  <div class="card-header p-0">
                     <h3 class="card-title p-3 ">
                        Dwell Time
                     </h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                        </div>
                  </div>
                  <div class="box-body text-center pt-3">
                     <div class="sparkline" data-type="pie" data-offset="90" data-width="100px" data-height="100px">
                        6,4,8
                     </div>
                  </div>
               </div>
            </div>-->
            
         </div>
      </div>
   </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="view_details" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
             <div class="modal-header">
          <h4 class="modal-title"><a href="<?php echo base_url();?>appointment"><i class="fa fa-angle-left"  aria-hidden="true"></i></a><span id="title_text">&nbsp;&nbsp; Add Slot</span></h4>
        </div>

        <div class="modal-body p-15px">
		<form class="form-signin" id="addslotform" name="addslotform">
         <input type="hidden" name="slot_id" id="slot_id">

		<div class="row">
		<div class="col-lg-8 col-sm-8 col-xs-12">
		<div class="form-group">
		<label class="text-center" for="male">Slot title</label>
		<input type="text" class="form-control" placeholder="Slot name" id="slot_name" name="slot_name" required>
		<!-- <small class="grid_optional">Optional</small> -->
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-lg-8 col-sm-8 col-xs-12">
		<div class="row">
		 <div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
		<label class="text-center" for="male">Start Time</label>
		<input type="text" class="form-control datetimepicker-input" id="slot_start_time" name="slot_start_time" data-toggle="datetimepicker" data-target="#slot_start_time" />
		</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-12">
      <div class="form-group">
      <label class="text-center" for="male">End Time</label>
      <input type="text" class="form-control datetimepicker-input" id="slot_end_time" name="slot_end_time" data-toggle="datetimepicker" data-target="#slot_end_time" />
      </div>
      </div>
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-lg-8 col-sm-8 col-xs-12">
		<div class="form-group radio_type">
		<p><strong>Type</strong></p>
		<input 
		type="radio" name="slot_type" 
		id="Online" class="input-hidden" value="Online" checked />
		<label class="text-center appointments" for="Online">
		<img src="<?php echo base_url();?>assets/img/doctor/online_appointment_bg.png" alt="Online" class="no_radious" /><br>
		Online
		</label>
		<input type="radio" name="slot_type" id="Offline" class="input-hidden" value="Offline" />
		<label class="text-center appointments" for="Offline">
		<img src="<?php echo base_url();?>assets/img/doctor/offline_appointment_bg.png" alt="Offline" class="no_radious" /><br>
		Offline
		</label>
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-lg-4 col-sm-6 col-xs-12">
		 <button type="submit" class="btn btn-primary btn-lg w-100">save</button>
		</div>
		</div>
		</form>
        </div>
      </div>
    </div>
  </div>


	<?= $this->include('templates/footer') ?>
<script src="<?=base_url()?>/dist/js/pages/dashboard3.js"></script>
<!-- ChartJS -->
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/demo.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>
<script id="rendered-js" >
   var ctx = document.getElementById("myChart4").getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
       labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September"],
       datasets: [{
         label: '425',
         backgroundColor: "#274f98",
         data: [12, 59, 5, 56, 58, 12, 59, 87, 45] },
       {
         label: '350',
         backgroundColor: "#4284ce",
         data: [12, 59, 5, 56, 58, 12, 59, 85, 23] },
       {
         label: '166',
         backgroundColor: "#5db9ee",
         data: [12, 59, 5, 56, 58, 12, 59, 65, 51] },
       {
         label: '119',
         backgroundColor: "#a3cbf9",
         data: [12, 59, 5, 56, 58, 12, 59, 12, 74] }] },
   
   
     options: {
       tooltips: {
         displayColors: true,
         callbacks: {
           mode: 'x' } },
   
   
       scales: {
         xAxes: [{
           stacked: true,
           gridLines: {
             display: false } }],
   
   
         yAxes: [{
           stacked: true,
           ticks: {
             beginAtZero: true },
   
           type: 'linear' }] },
   
   
       responsive: true,
       maintainAspectRatio: false,
       legend: { position: 'bottom' } } });
   //# sourceURL=pen.js
       
</script>
<script>
  $(function () {
    /* jQueryKnob */

    $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            //ea = this.startAngle + this.angle(this.value +'%')
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

  })

</script>
<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines();
    drawMouseSpeedDemo();

  });
  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red'});


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
        {type: 'line', height: '2.5em', width: '4em'});

    // Customized line chart
    $('#linecustom').sparkline('html',
        {
          height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
          minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
        });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {type: 'bar'});

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
      type: 'bar',
      tooltipFormat: '{{value:levels}} - {{value}}',
      tooltipValueLookups: {
        levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
      }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', {type: 'tristate'});
    $('.sparktristatecols').sparkline('html',
        {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
        {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
    $('#normalExample').sparkline('html',
        {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

    // Discrete charts
    $('.discrete1').sparkline('html',
        {type: 'discrete', lineColor: 'blue', xwidth: 18});
    $('#discrete2').sparkline('html',
        {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

    // Bullet charts
    $('.sparkbullet').sparkline('html', {type: 'bullet'});

    // Pie charts
    $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

    // Box plots
    $('.sparkboxplot').sparkline('html', {type: 'box'});
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
        {type: 'box', raw: true, showOutliers: true, target: 6});

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type: 'box',
      tooltipFormatFieldlist: ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('');
    });
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
      var mousex = e.pageX;
      var mousey = e.pageY;
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
      }
      lastmousex = mousex;
      lastmousey = mousey;
    });
    var mdraw = function () {
      var md = new Date();
      var timenow = md.getTime();
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
        mpoints.push(pps);
        if (mpoints.length > mpoints_max)
          mpoints.splice(0, 1);
        mousetravel = 0;
        $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
      }
      lastmousetime = timenow;
      setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script>
<!-- page script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
          'Opera', 
          'Navigator', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })

$(document).on('change','.branch_details',function(e){
  var branch_id=$('#branch_details').val();
  var customer_id=$('#account_id').val();

   var html = ''; 
    $.ajax({
       type:'POST',
       url: "<?php echo base_url();?>/report/get_branch",
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
    
      }
      }); 
 });


</script>
<?= $this->endSection() ?>