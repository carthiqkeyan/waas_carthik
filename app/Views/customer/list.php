<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 border-bottom pb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><span class="blue_text">1</span>List Customer Management</h1>
                <small>Create users / customers assign user roles as per customer</small>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!--<li class="breadcrumb-item"><a href="<?= base_url();?>/role/list">Back to Roles List</a></li>-->
                </ol>
            </div>
            <!-- /.col -->
        </div>
<div class="row mb-2 pb-3">
<div class="col-lg-12 col-sm-12 col-xs-12">
<div class="card">
    <!--<div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
    </div>-->
    <!-- /.card-header -->
    <div class="card-body">
       <?php if (in_array('add', $action_access)) { ?>
      	<div class="table-data__tool-right text-lg-right text-sm-right text-center">
	      <div class="col-lg-3 col-sm-4 col-xs-12 ml-auto">
             <a href="<?php base_url();?>account" class="mb-0 mb-0go">
			  <button class="btn btn-primary">
               <i class="fa fa-plus" aria-hidden="true"></i>Create Customer
			  </button>
			  </a>
		   </div>
    </div>
      <?php } ?>
      <!--<div class="table-data__tool-right">
          <a href="<?php base_url();?>account" class="mb-0"><button class="add-button">
            <i class="fa fa-plus" aria-hidden="true"></i>Create Customer</button></a>
      </div>-->
         <table id="role_datatable" name="role_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Customer Name</th>
                            <th>Customer email</th>
                            <th>Customer license</th>
                           <!--  <th>Memebership</th>
                            <th>Last login</th> -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
            <tbody>
                <?php
                if (is_array($arr_customer) && count($arr_customer) != 0) {
                    foreach ($arr_customer as $key=>$customer) {
                ?>
  
                    <tr>
                        <td><?= ++$key;?></td>
                        <td><?= $customer['account_name'];?></td>
                        <td><?= $customer['email'];?></td>
                       <td><?= $customer['license'];?></td>
                        <td><?= ($customer['status']==1)?"Active":"Suspend";?></td>
                        <td>
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="services dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-ellipsis-v" data-toggle="dropdown" aria-hidden="true"></i>
                                    <!--<span class="caret"></span>--></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown-item"><a href="#" onclick="cus_status('<?= $customer['id']; ?>','<?= $customer['status']; ?>');"><?= ($customer['status']==1)?"<i class='fa fa-pause'></i> &nbsp; Suspend":" <i class='fa fa-undo'></i> &nbsp; Revoke";?></a></li>
                                    <?php if (in_array('view_all', $action_access)) { ?>
                                    <li class="dropdown-item"><a href="<?php base_url();?>view/<?= $customer['uniqueID'];?>"><i class="fa fa-eye"></i> &nbsp;View</a></li>
                                      <?php } ?>
                                    <?php if (in_array('edit', $action_access)) { ?>
                                    <li class="dropdown-item"><a href="<?php base_url();?>account/<?= $customer['uniqueID'];?>"> <i class="fa fa-edit"></i> &nbsp;Edit</a></li>
                                     <?php } ?>
                                    <?php if (in_array('delete', $action_access)) { ?>
                                    <li class="dropdown-item"><a href="#" onclick="delete_cus('<?= $customer['id']; ?>');"> <i class="fa fa-trash"></i> &nbsp;Delete</a></li>
                                     <?php } ?>
                                </ul>
                            </div>
         
                        </td>
  <!--                       <td style="position: relative;">      
                                    
                        <a class="blue_text font_16 btn_bx" href="<?php base_url();?>view/<?= $customer['id'];?>"><i class="fas fa-eye-alt"></i></a>
           
                        <a class="blue_text font_16 btn_bx" href="<?php base_url();?>account/<?= $customer['id'];?>"><i class="fas fa-pencil-alt"></i></a>
   
                        <a class="blue_text font_16 btn_bx red" href="<?php base_url();?>delete/<?= $customer['id'];?>"><i class="fas fa-trash"></i></a>

                         </td> -->
                    </tr>
                <?php
                    }
                }
                ?>
        </table>

    </div>
    <!-- /.card-body -->
</div>
</div>
</div>
</div>
</div>
<?= $this->include('templates/footer') ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#action_menu').hide();
  $('#action_menu_btn').click(function(){
    console.log($(this).attr('rel'));return false;
  $('.action_menu').toggle();
});

$(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });


});
    var Dtable;
    $(document).ready(function () {
        Dtable = $("#role_datatable").DataTable();
    });
    $('#role_datatable').on('click', '.role_edit', function () {

        var RowIndex = $(this).closest('tr');
         data = Dtable.row(RowIndex).data();
         window.location.href = BASE_URL+"/role/editrole/"+data[0]+"";

    });
    $('#role_datatable').on('click', '.role_delete', function () {
         // alert('test');
          var RowIndex = $(this).closest('tr');
          data_id = Dtable.row(RowIndex).data();
         alert(data_id[0]);
          jQuery.ajax({
          type: "POST",
          url: BASE_URL+"/role/delete/"+data_id[0],
          data : {id:data_id[0]},
          success: function(response) {
            if(response.status == true){
          alert("Deleted successfuly");
          window.location.reload(true);
          }
        }
       });
      });
</script>
<script type="text/javascript">
    var el = document.querySelector('.more');
    var btn = el.querySelector('.more-btn');
    var menu = el.querySelector('.more-menu');
    var visible = false;

    function showMenu(e) {
        e.preventDefault();
        if (!visible) {
            visible = true;
            el.classList.add('show-more-menu');
            menu.setAttribute('aria-hidden', false);
            document.addEventListener('mousedown', hideMenu, false);
        }
    }

    function hideMenu(e) {
        if (btn.contains(e.target)) {
            return;
        }
        if (visible) {
            visible = false;
            el.classList.remove('show-more-menu');
            menu.setAttribute('aria-hidden', true);
            document.removeEventListener('mousedown', hideMenu);
        }
    }

    btn.addEventListener('click', showMenu, false);

      function delete_cus(cus_id) {
        if (cus_id != 0) {
            var params = [];
            params.push({
                'name': 'id',
                'value': cus_id
            });
            var action_url = BASE_URL + "customer/delete";
            delete_confirmation_message(params, action_url);

        }
    }

      function cus_status(cus_id,status) {
        if (cus_id != 0) {
            var params = [];
            var status=status;
            if (status==1) {
              cus_status=2;
            }else
            {
              cus_status=1;
            }
            params.push({
                'name': 'id',
                'value': cus_id,

            });
            params.push({'name':'status','value':cus_status});
            var action_url = BASE_URL + "customer/cus_status";
            cus_status_confirmation_message(params, action_url);

        }
    }
</script>
<?= $this->endSection() ?>