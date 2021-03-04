<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 border-bottom pb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><span class="blue_text">1</span>Access Control</h1>
                <small>Create users / customers assign user roles as per customer</small>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <div class="row mb-2 pb-3">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <form role="form" id="form_role" name="form_role" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="rolename">Role name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="User role name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter description.... "></textarea>
                                </div>
                                <div class="list-group">
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-sm-12 col-xs-12" for="exampleInputPassword1">Customer option</label>
                                        <div class="col-lg-6 col-sm-6 col-xs-12 pr-0">
                                            <input type="radio" name="status" value="1" id="Radio1" />
                                            <label class="list-group-item" for="Radio1">Mobility Mea</label>
                                            <input type="hidden" name="id" id="id">
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12 pl-0">
                                            <input type="radio" name="status" value="2" id="Radio2" />
                                            <label class="list-group-item" for="Radio2">Business customer</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Choose customer</label>
                                    <select class="form-control">
                                        <option>customer 1</option>
                                        <option>customer 2</option>
                                        <option>customer 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="row mb-2 pt-3 border-top">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><span class="blue_text">2</span>Role access
                    <span class="blue_text font_21">Update role access <i class="fa fa-pencil" aria-hidden="true"></i></span></h1>
                <p class="mt-2">List of user access for this role</p>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="grid_bx_cont">
                            <h4>Account Management</h4>
                            <ul>
                                <li>Create customer account</li>
                                <li>Edit customer account</li>
                                <li>View all accounts</li>
                                <li>Enable campaign capabilities(SMS, Email, WAAS Captive portal)</li>
                                <li>Commence & Expiry Date</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="grid_bx_cont">
                            <h4>Special Request</h4>
                            <ul>
                                <li>Access customer details</li>
                                <li>View all accounts</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="grid_bx_cont">
                            <h4>User Management</h4>
                            <ul>
                                <li>Create User</li>
                                <li>Edit User</li>
                                <li>Delete User</li>
                                <li>Change Own Password</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="grid_bx_cont">
                            <h4>User Role</h4>
                            <ul>
                                <li>Create User</li>
                                <li>Edit User</li>
                                <li>Delete User</li>
                                <li>Change Own Password</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="grid_bx_cont">
                            <h4>Authorization/Privilege</h4>
                            <ul>
                                <li>Create User</li>
                                <li>Edit User</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="grid_bx_cont">
                            <h4>Campaign Management</h4>
                            <ul>
                                <li>Create User</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="grid_bx_cont">
                            <h4>Reports</h4>
                            <ul>
                                <li>Create User</li>
                                <li>Edit User</li>
                                <li>Delete User</li>
                                <li>Change Own Password</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="box-footer">

                            <button type="button" id="role_save" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!--<?//= $this->include('templates/footer') ?>-->
<script>

</script>
<?= $this->endSection() ?>