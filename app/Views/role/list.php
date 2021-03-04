<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 border-bottom pb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><span class="blue_text">1</span><?= $table_title;?></h1>
                <small>Create users / customers assign user roles as per customer</small>
            </div>
        </div>
        <div class="row mb-2 pb-3">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="card">
                    <!--<div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
    </div>-->
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (isset($_SESSION['role_name']) || in_array('add', $action_access)) { ?>
                            <div class="table-data__tool-right  text-lg-right text-sm-right text-center">
                                <div class="col-lg-3 col-sm-4 col-xs-12 ml-auto">
                                    <a href="<?php base_url(); ?>add " class="mb-0 mb-0go">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-plus" aria-hidden="true"></i>Create Role
                                        </button>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                        <table id="role_datatable" name="role_datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Role Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($arr_roles) && count($arr_roles) != 0) {
                                    foreach ($arr_roles as $key => $role) {
                                        $rolename = $ROLE_NAMES[$role['is_customer_role']];
                                ?>
                                        <tr>
                                            <td><?= ++$key; ?></td>
                                            <td><?= $role['name']; ?></td>
                                            <td><?= $rolename;?></td>
                                            <td><?= ($role['status'] == 1) ? "Active" : "Inactive"; ?></td>
                                            <!--<td>
                                                <?php if (in_array('edit', $action_access)) { ?>
                                                    <a class="blue_text font_16 btn_bx" href="<?= base_url(); ?>/role/edit/<?= $role['id']; ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <?php } ?>
                                                <?php if (in_array('delete', $action_access)) { ?>
                                                    <a class="blue_text font_16 btn_bx red" href="#" onclick="delete_role('<?= $role['id']; ?>');"><i class="fas fa-trash"></i></a>
                                                <?php } ?>
                                            </td>-->
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="services dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-ellipsis-v" data-toggle="dropdown" aria-hidden="true"></i>
                                                        <!--<span class="caret"></span>--></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <?php if (in_array('edit', $action_access)) { ?>
                                                            <li class="dropdown-item"><a href="<?php base_url(); ?>view/<?= $role['id']; ?>"><i class="fa fa-eye"></i> &nbsp; View</a></li>
                                                        <?php } ?>
                                                        <?php if (in_array('edit', $action_access) && ($_SESSION['role_id']!=$role['id'])) { ?>
                                                            <li class="dropdown-item"><a href="<?php base_url(); ?>edit/<?= $role['id']; ?>"><i class="fa fa-edit"></i> &nbsp;  Edit</a></li>
                                                        <?php } ?>
                                                        <?php if (in_array('delete', $action_access) && ($_SESSION['role_id']!=$role['id'])) { ?>
                                                            <li class="dropdown-item"><a href="#" onclick="delete_role('<?= $role['id']; ?>');"><i class="fa fa-trash"></i> &nbsp; Delete</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </td>
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
    // $("#role_datatable").DataTable({
    //     "paging": true,
    //     "responsive": true,
    //     "autoWidth": false,
    //     "searching": true,
    //     "ordering": true,
    //     "info": true
    // });
    var Dtable;
    $(document).ready(function() {
        Dtable = $("#role_datatable").DataTable();
    });
    
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });

    // delete role 
    function delete_role(role_id) {
        if (role_id != 0) {
            var params = [];
            params.push({
                'name': 'id',
                'value': role_id
            });
            var action_url = BASE_URL + "/role/delete";
            delete_confirmation_message(params, action_url);
            // jQuery.ajax({
            // type: "POST",
            // url: BASE_URL+"/role/delete",
            // data : {id:role_id},
            //     success: function(response) {
            //         if(response.status == true){
            //             // alert("Deleted successfuly");
            //             // alert(response.message);
            //             success_message(response.message,'Confirmation')
            //             window.location.reload(true);
            //         }
            //     }
            // });
        }
    }
    $('#role_datatable').on('click', '.role_edit', function() {

        var RowIndex = $(this).closest('tr');
        data = Dtable.row(RowIndex).data();
        window.location.href = BASE_URL + "/role/editrole/" + data[0] + "";
        //alert(data[0]);
        //     jQuery.ajax({
        //     type: "POST",
        //     url:BASE_URL+"/role/edit/"+data[0]+"",
        //     data: {id:data[0]},
        //     success: function(response) {
        //         var data = JSON.parse(response);
        //        // window.location.href = BASE_URL+"/role/add";
        //     }
        //   });
    });
    /*
    $('#role_datatable').on('click', '.role_delete', function () {
         // alert('test');
          var RowIndex = $(this).closest('tr');
          data_id = Dtable.row(RowIndex).data();
          jQuery.ajax({
          type: "POST",
          url: BASE_URL+"/role/delete/"+data_id[0],
          data : {id:data_id[0]},
          success: function(response) {
            if(response.status == true){
                // alert("Deleted successfuly");
                alert(response.message);
                window.location.reload(true);
            }
        }
       });
      });*/
</script>
<?= $this->endSection() ?>