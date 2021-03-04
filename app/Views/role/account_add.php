<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->

            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Account Management</h1>
						<small>All access in account management module</small>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
				  <div class="row mb-2">
					<div class="col-lg-8 col-sm-8 col-xs-12">
					<div class="box-body">
					<div class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
					<table class="table-responsive table" id="account_table" cellpadding="5px">
					<tr><th><input type="checkbox" id="selectall" class="regular-checkbox" /><label for="selectall"></th><th>Select All</th></tr>
                <?php
                if (is_array($arr_name) && count($arr_name) != 0) {
                    foreach ($arr_name as $key=>$accname) {
                ?>
					<td width="20" align="center"><input type="checkbox" name="name" class="regular-checkbox name" value='<?= $accname['module_id']?>' id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
					<td>
               <h4><?= $accname['name']?></h4>
					<!-- <span id="module_id" name="module_id"><?= $accname['module_id']?></span> -->
               <p>Lorem ipsum is latin, slightly jumbled, the remnants of a passage from Cicero's 'De finibus bonorum et malorum' 1.10.32, which begins 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...'</p>
					</td>
					</tr>
                    <?php
                    }
                }
                ?>
              
					 </table>
					</div>
					</div>
					</div>
					<div class="box-footer">
					<button type="button" id="account_save" class="btn btn-primary">Save</button>
					</div>
					</div>
               <div class="col-lg-4 col-sm-4 col-xs-12">
               <div class="test_p">
               <!-- <p id="account_name"></p> -->
               <span  id="access_id"></span>
               </div>
               </div>
				  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
        
        <?= $this->include('templates/footer') ?>
<script>
  $(document).ready(function() {

   var baseUrl = (window.location).href; // You can also use document.URL
    ID= baseUrl.substring(baseUrl.lastIndexOf('/') + 1);

        // add multiple select / deselect functionality
        $("#selectall").click(function () {
            $('.name').attr('checked', this.checked);
            var chk_val = [];
        $(':checkbox:checked').each(function(i){
         chk_val[i] = $(this).val();
        });
       
         var chk_val_all=chk_val.slice(1, -1);
         alert(chk_val_all);
        jQuery.ajax({
             type: "POST",
             url:BASE_URL+"/role/account_list/"+chk_val_all+"",
             success: function(response) {
               console.log(response);
                for(i=0;i<response.length;i++){
                   console.log(response[i].name);
               var tab='';
                  tab +='<p id="account_name"  value='+response[i].id+'>' + response[i].name + '</p>';
                  tab +='<span hidden class="access_id" id="access_id" value='+response[i].id+'>'+response[i].id+'</span>';
                  $(".test_p").append(tab);
                }
            
                //$(".test_p").append(tab);
           }
        });
        });


        // if all checkbox are selected, then check the select all checkbox
        // and viceversa
        $(".name").click(function () {
      //   var chk_val = $(this).attr("value");
         var chk_val = [];
        $(':checkbox:checked').each(function(i){
         chk_val[i] = $(this).val();
        });
        
            if ($(".name").length == $(".name:checked").length) {
                $("#selectall").attr("checked", "checked");
            } else {
                $("#selectall").removeAttr("checked");
            }
             jQuery.ajax({
             type: "POST",
             url:BASE_URL+"/role/account_list/"+chk_val+"",
             success: function(response) {
               console.log(response);
                for(i=0;i<response.length;i++){
                 //  console.log(response[i].name);
                // $(".test_p").append('<p id="access_id"  value='+response[i].id+'>' + response[i].name + '</p>');
                  var tab='';
                  tab +='<p id="account_name"  value='+response[i].id+'>' + response[i].name + '</p>';
                  tab +='<span hidden class="access_id" id="access_id" value='+response[i].id+'>'+response[i].id+'</span>';
                }
                $(".test_p").append(tab);
           }
        });
      });		


      var myObj= [];
      $("#account_save").click(function() {
       var baseUrl = (window.location).href; // You can also use document.URL
       var Id = baseUrl.substring(baseUrl.lastIndexOf('/') + 1);
       console.log(Id);
         var data = {};
        // var acc=[];
         $('.name').attr('checked', this.checked);
            var chk_val = [];
        $(':checkbox:checked').each(function(i){
         chk_val[i] = $(this).val();
        });

        var array_first=chk_val[0];
        if (array_first == "on"){
          module_id_val=chk_val.slice(1, -1); 
        }else{
          module_id_val=chk_val;
        }


        var access_id=$(".access_id").text();
        var access_id_comma = numberWithCommas(access_id);
        var access_id_val=access_id_comma.split(',');
        data.module_id=module_id_val;
        data.access_id=access_id_val;
        data.role_id=Id;
        myObj.push(data);
        console.log(myObj);
      jQuery.ajax({
        type: "POST",
        url: BASE_URL+"/role/account_save",
     //   data:JSON.stringify(myObj),
        data : {
           role_id :  data.role_id,
           module_id : data.module_id,
           access_id : data.access_id
        },
        success: function(response) {
           console.log(response);
        }
      });
      });
    });
    function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{1})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>
<?= $this->endSection() ?>
 