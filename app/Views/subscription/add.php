<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
       <div class="col-sm-6">
          <h1 class="m-0 text-dark">Subscriptions Management</h1>
          <small>Create users / subscriptions assign user roles as per customer</small>
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
  <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  <!--  <input type="hidden" name="end_date" id="end_date" value="<?php echo isset($arr_subDetails['end_date']);?>"> -->
    <div class="text-danger" id='role_error' name='role_error'>
    </div>
   
			<div class="box-body">
			<div class="row">
      <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Subscription Period Start Date</label>
      <input type="date" class="form-control start_today" id="start_date" name="start_date" title="Start Date" value="<?php echo isset($arr_subDetails['start_date']) ? date_format(date_create($arr_subDetails['start_date']),"Y-m-d")  : date('Y-m-d'); ?>"  required  > 
       <!-- <input type="date" class="form-control" name="start_date" id="start_date"  onchange="set_due_date(this.value)"> -->
      </div>
      </div>
      </div>
      </div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="col-xlg-6">
			<div class="form-group">
			<label for="rolename">Subscription Period Month or Year</label>
      <?php
          $periodArr = ['3 Month','6 Month','9 Month','1 Year','3 Year'];
        ?>
         <select id="package_month"  class="form-control"  name="package_month" onchange="set_due_date(this.value)">
           <option class="status-text"><p>Select Your package</p></option>
          <?php
            foreach($periodArr as $value) {
              $selected = (isset($arr_subDetails['package_month']) && $arr_subDetails['package_month'] == $value) ? 'selected' : '';
              ?>
                <option value="<?php echo  $value; ?>" <?= $selected; ?>><?php echo $value;?></option>
              <?php
            }
          ?>                
        </select>
			  </div>
       </div>
      </div>

   <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Subscription Period End Date *</label>
      <input type="date" class="form-control start_today" id="end_date" name="end_date" title="End Date" value="<?php echo isset($arr_subDetails['end_date']); ?>"  required  > 
      </div>
      </div>
      </div>
      </div>
  
			<div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Description *</label>
      <input type="text" class="form-control" id="description" name="description" value="<?php echo isset($arr_subDetails['description']) ? $arr_subDetails['description'] : ''; ?>" placeholder="Enter description" required>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="rolename">Customer List *</label>
    <!--   <input type="text" class="form-control" id="customers" name="customers" placeholder="Ex. ABC Incorporate"> -->
      <select id="customers" name="customers" class="form-control" required>
          <option value=''> Select Customer </option>
          <?php if (is_array($customer) && count($customer) != 0) {
              foreach ($customer as $row) {
                  $selected = (isset($arr_subDetails['customers']) && $arr_subDetails['customers'] == $row['id']) ? 'selected' : '';
          ?>
                 <option value="<?= $row['id']; ?>" <?= $selected; ?>><?= $row['email']; ?></option>
          <?php
              }
         } ?>
      </select>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label for="exampleInputPassword1">Status</label>
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
	  
      <!-- <div class="col-lg-4 col-sm-6 col-xs-12">
      <div class="form-group">
       <div class="col-xlg-6">
      <div class="form-group">
      <label for="rolename">Subscription Period End Date</label>
       <input type="text" class="form-control " name="end_date" id="end_date" >
      </div>
      </div>
      </div>
      </div> -->
    </div>
      <div class="row">
      
    </div>
      <div class="row">
      
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

<?= $this->include('templates/footer') ?>
<script>
 
     // $('.start_today').datepicker({
     //  todayHighlight: true,
     //  format: 'yyyy-mm-dd',
     //  startDate: new Date()   
     //  }); 

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
          // Add the `help-block` class to the error element
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
           url: "<?php base_url();?>save",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
 
                 var data=$.parseJSON(data);
                     if(data.status =="1"){
                         success_message('Subscription Successfully');
                          window.location.href=BASE_URL+'subscription/list';
                                            
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

     /* var myDate = new Date(date);
      var month = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ][myDate.getMonth()];*/
      //var str = myDate.getDate() + "-" + month + "-" + myDate.getFullYear();
      //var str = myDate.getMonth()+ "/" + myDate.getDate() + "/" + myDate.getFullYear();
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
          var str =formatDate(d1);
         $("#end_date").val(str);
         console.log(str);
         }
         else if(val=='6 Month')
         {
          var d1=addMonths(new Date(d),6).toString();
         var newdate = Date('')
          var str =formatDate(d1);
         $("#end_date").val(str);
         }
         else if (val=='9 Month') {
         var d1=addMonths(new Date(d),9).toString();
         var newdate = Date('')
         var str =formatDate(d1);
         $("#end_date").val(str);
         }

         /*else if(val=='6 Month'){
           // d.setDate(15);
            d=new Date().getTime()+(15*24*60*60*1000)
            var str =formatDate(d);
            $("#due_date").datepicker("setDate", str);
         }else if(val=='9 Month'){
            d=new Date().getTime()+(30*24*60*60*1000)
            var str =formatDate(d);
            $("#due_date").datepicker("setDate", str);
         }else if(val=='1 Year'){
            d=new Date().getTime()+(45*24*60*60*1000)
            var str =formatDate(d);
            $("#due_date").datepicker("setDate", str);
         }else if(val=='3 Year'){
            d=new Date().getTime()+(60*24*60*60*1000)
            var str =formatDate(d);
            $("#due_date").datepicker("setDate", str);
         }else if(val=='Due end of the month'){
            d=new Date(d.getFullYear(), d.getMonth() + 1, 0);
            var str =formatDate(d);
            $("#due_date").datepicker("setDate", str);
         }else if(val=='Due end of next month'){
            d=new Date(d.getFullYear(), d.getMonth() + 2, 0);
            var str =formatDate(d);
            $("#due_date").datepicker("setDate", str);
         }else if(val=='As per credit period'){
            var period=$("#credit_period").val();
            d=new Date().getTime()+(period*24*60*60*1000)
            var str =formatDate(d);
            $("#due_date").datepicker("setDate", str);
         }else {
            $("#due_date").datepicker("setDate", "0");
         } */         
      }





//    Array.prototype.search = function(elem) {
//     for(var i = 0; i < this.length; i++) {
//         if(this[i] == elem) return i;
//     }
    
//     return -1;
// };

// var Multiselect = function(selector) {
//     if(!$(selector)) {
//         console.error("ERROR: Element %s does not exist.", selector);
//         return;
//     }

//     this.selector = selector;
//     this.selections = [];

//     (function(that) {
//         that.events();
//     })(this);
// };

// Multiselect.prototype = {
//     open: function(that) {
//         var target = $(that).parent().attr("data-target");

//         // If we are not keeping track of this one's entries, then
//         // start doing so.
//         if(!this.selections) {
//             this.selections = [ ];
//         }

//         $(this.selector + ".multiselect").toggleClass("active");
//     },

//     close: function() {
//         $(this.selector + ".multiselect").removeClass("active");
//     },

//     events: function() {
//         var that = this;

//         $(document).on("click", that.selector + ".multiselect > .title", function(e) {
//             if(e.target.className.indexOf("close-icon") < 0) {
//                 that.open();
//             }
//         });

//         $(document).on("click", that.selector + ".multiselect option", function(e) {
//             var selection = $(this).attr("value");
//             var target = $(this).parent().parent().attr("data-target");

//             var io = that.selections.search(selection);

//             if(io < 0) that.selections.push(selection);
//             else that.selections.splice(io, 1);

//             that.selectionStatus();
//             that.setSelectionsString();
//         });

//         $(document).on("click", that.selector + ".multiselect > .title > .close-icon", function(e) {
//             that.clearSelections();
//         });

//         $(document).click(function(e) {
//             if(e.target.className.indexOf("title") < 0) {
//                 if(e.target.className.indexOf("text") < 0) {
//                     if(e.target.className.indexOf("-icon") < 0) {
//                         if(e.target.className.indexOf("selected") < 0 ||
//                            e.target.localName != "option") {
//                             that.close();
//                         }
//                     }
//                 }
//             }
//         });
//     },

//     selectionStatus: function() {
//         var obj = $(this.selector + ".multiselect");

//         if(this.selections.length) obj.addClass("selection");
//         else obj.removeClass("selection");
//     },

//     clearSelections: function() {
//         this.selections = [];
//         this.selectionStatus();
//         this.setSelectionsString();
//     },

//     getSelections: function() {
//         return this.selections;
//     },

//     setSelectionsString: function() {
//         var selects = this.getSelectionsString().split(", ");
//         $(this.selector + ".multiselect > .title").attr("title", selects);

//         var opts = $(this.selector + ".multiselect option");

//         if(selects.length > 6) {
//             var _selects = this.getSelectionsString().split(", ");
//             _selects = _selects.splice(0, 6);
//             $(this.selector + ".multiselect > .title > .text")
//                 .text(_selects + " [...]");
//         }
//         else {
//             $(this.selector + ".multiselect > .title > .text")
//                 .text(selects);
//         }

//         for(var i = 0; i < opts.length; i++) {
//             $(opts[i]).removeClass("selected");
//         }

//         for(var j = 0; j < selects.length; j++) {
//             var select = selects[j];

//             for(var i = 0; i < opts.length; i++) {
//                 if($(opts[i]).attr("value") == select) {
//                     $(opts[i]).addClass("selected");
//                     break;
//                 }
//             }
//         }
//     },

//     getSelectionsString: function() {
//         if(this.selections.length > 0)
//             return this.selections.join(", ");
//         else return "Select";
//     },

//     setSelections: function(arr) {
//         if(!arr[0]) {
//             error("ERROR: This does not look like an array.");
//             return;
//         }

//         this.selections = arr;
//         this.selectionStatus();
//         this.setSelectionsString();
//     },
// };

// $(document).ready(function() {
//     var multi = new Multiselect("#month");
//     var multi1 = new Multiselect("#year");
// });


</script>
<?= $this->endSection() ?>
