<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 border-bottom pb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Subscription Management</h1>
                <small>Create Subscription plans for customers</small>
            </div>
            <!-- /.col --
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Back to Roles List</a></li>
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
                    <div class="table-data__tool-right text-lg-right tet-sm-right text-center">
                        <div class="col-lg-3 col-sm-4 col-xs-12 ml-auto">
                            <a href="<?php base_url(); ?>add" class="mb-0go">
                                <button class="btn btn-primary">
                                    <i class="fa fa-plus" aria-hidden="true"></i>Create Subscription
                                </button>
                            </a>
                        </div>
                    </div>
                     <?php } ?>
                        <table id="role_datatable" name="role_datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Package</th>
                                    <th>Description</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <style>
                                    #action_menu_btn {
                                        position: absolute;
                                        right: 15px;
                                        top: 35%;
                                        color: white;
                                        cursor: pointer;
                                        font-size: 20px;
                                    }

                                    .action_menu {
                                        z-index: 1;
                                        position: absolute;
                                        padding: 0px 0;
                                        background-color: rgba(0, 0, 0, 0.5);
                                        color: white;
                                        border-radius: 10px;
                                        top: 46px;
                                        right: 15px;
                                        display: none;
                                    }

                                    .action_menu ul {
                                        list-style: none;
                                        padding: 0;
                                        margin: 0;
                                    }

                                    .action_menu ul li {
                                        width: 100%;
                                        padding: 10px 15px;
                                        margin-bottom: 5px;
                                    }

                                    .action_menu ul li i {
                                        padding-right: 10px;

                                    }

                                    .action_menu ul li:hover {
                                        cursor: pointer;
                                        background-color: rgba(0, 0, 0, 0.2);
                                    }
                                </style>
                                <?php
                                if (is_array($arr_subscription) && count($arr_subscription) != 0) {
                                    foreach ($arr_subscription as $key => $subscription) {
                                ?>

                                        <tr>
                                            <td><?= ++$key; ?></td>
                                            <td><?= $subscription['package_month']; ?></td>
                                            <td><?= $subscription['description']; ?></td>
                                            <td><?= $subscription['email']; ?></td>
                                            <td><?= ($subscription['status'] == 1) ? "Active" : "Inactive"; ?></td>
                                           
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="services dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-ellipsis-v" data-toggle="dropdown" aria-hidden="true"></i>
                                                        <!--<span class="caret"></span>--></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <?php if (in_array('view_all', $action_access)) { ?>
                                                        <li class="dropdown-item"><a href="<?php base_url(); ?>view/<?= $subscription['id']; ?>"><i class="fa fa-eye"></i> &nbsp; View</a></li>
                                                         <?php } ?>
                                                         <?php if (in_array('edit', $action_access)) { ?>
                                                        <li class="dropdown-item"><a href="<?php base_url(); ?>edit/<?= $subscription['id']; ?>"><i class="fa fa-edit"></i> &nbsp; Edit</a></li>
                                                         <?php } ?>
                                                         <?php if (in_array('delete', $action_access)) { ?>
                                                        <li class="dropdown-item"><a href="#" onclick="delete_sub('<?= $subscription['id']; ?>');"><i class="fa fa-trash"></i> &nbsp; Delete</a></li>
                                                           <?php } ?>
                                                    </ul>
                                                </div>
                                                <!-- /btn-group -->
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
<script src="<?= base_url() ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#action_menu').hide();
        $('#action_menu_btn').click(function() {
            console.log($(this).attr('rel'));
            return false;
            $('.action_menu').toggle();
        });
    });
    var Dtable;
    $(document).ready(function() {
        Dtable = $("#role_datatable").DataTable();
    });
    $('#role_datatable').on('click', '.role_edit', function() {

        var RowIndex = $(this).closest('tr');
        data = Dtable.row(RowIndex).data();
        window.location.href = BASE_URL + "/role/editrole/" + data[0] + "";

    });
    $('#role_datatable').on('click', '.role_delete', function() {
        // alert('test');
        var RowIndex = $(this).closest('tr');
        data_id = Dtable.row(RowIndex).data();
        alert(data_id[0]);
        jQuery.ajax({
            type: "POST",
            url: BASE_URL + "/role/delete/" + data_id[0],
            data: {
                id: data_id[0]
            },
            success: function(response) {
                if (response.status == true) {
                    alert("Deleted successfuly");
                    window.location.reload(true);
                }
            }
        });
    });
</script>
<script type="text/javascript">
    function delete_sub(sub_id) {
        if (sub_id != 0) {
            var params = [];
            params.push({
                'name': 'id',
                'value': sub_id
            });
            var action_url = BASE_URL + "/subscription/delete";
            delete_confirmation_message(params, action_url);

        }
    }
</script>
<?= $this->endSection() ?>