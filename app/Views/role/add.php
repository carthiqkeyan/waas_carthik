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
            <?php if (isset($_SESSION['role_name']) || in_array('view_all', $action_access)) { ?>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php base_url(); ?>list"><i class="fas fa-chevron-circle-left"></i> &nbsp; Roles List</a></li>
                    </ol>
                </div>
            <?php } ?>
            <!-- /.col -->
        </div>
        <div class="row mb-2 pb-3">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <form role="form" id="form_role" name="form_role" method="POST">
                    <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="rolename">Role name</label>
                                    <input <?= $readonly; ?> type="text" class="form-control " id="name" name="name" placeholder="User role name" value="<?= isset($arr_role['name']) ? $arr_role['name'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <input <?= $readonly; ?> type="text" class="form-control" id="description" name="description" placeholder="Role Description" value="<?= isset($arr_role['description']) ? $arr_role['description'] : ''; ?>">
                                    <!--<textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter description.... "><?= isset($arr_role['description']) ? $arr_role['description'] : ''; ?></textarea>-->
                                </div>
                                <div class="list-group">
                                    <label for="exampleInputPassword1">Role Type </label>
                                    <?php
                                    if (isset($arr_role['is_customer_role'])) {
                                        $mob_check = ($arr_role['is_customer_role'] == 0) ? 'checked' : '';
                                        $cust_check = ($arr_role['is_customer_role'] == 1) ? 'checked' : '';
                                        $branch_check = ($arr_role['is_customer_role'] == 2) ? 'checked' : '';
                                    } else {
                                        $mob_check = 'checked';
                                        $cust_check = 'checked';
                                        $branch_check = '';
                                    }
                                    ?>
                                    <!--<div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-check">
                                                <input <?= $readonly; ?> type="checkbox" class="form-check-input" id="is_customer_role" name="is_customer_role" <?= $mob_check; ?> value="0">
                                                <label class="form-check-label" for="exampleCheck1">Mobility Mea Role</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <div class="form-check">
                                                <input <?= $readonly; ?> type="checkbox" class="form-check-input" id="is_customer_role" name="is_customer_role" <?= $cust_check; ?> value="1">
                                                <label class="form-check-label" for="exampleCheck1">Customer Role</label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <?php  if (isset($arr_role['is_customer_role'])) { ?>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input <?= $readonly; ?> class="custom-control-input" type="radio" id="mobility_role" name="is_customer_role" value="0" <?= $mob_check; ?> >
                                                    <label for="mobility_role" class="custom-control-label">Mobility Mea Role</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input <?= $readonly; ?> class="custom-control-input" type="radio" id="customer_role" name="is_customer_role" <?= $cust_check; ?> value="1">
                                                    <label for="customer_role" class="custom-control-label">Customer Role</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input <?= $readonly; ?> class="custom-control-input" type="radio" id="branch_role" name="is_customer_role" <?= $branch_check; ?> value="2">
                                                    <label for="branch_role" class="custom-control-label">Branch Role</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!--<div class="form-group row">
                                        <label class="col-lg-12 col-sm-12 col-xs-12" for="exampleInputPassword1">Customer option</label>
                                        <div class="col-lg-6 col-sm-6 col-xs-12 pr-0">
                                            <input type="radio" name="is_customer_role" id="is_customer_role_1" value="1" id="Radio1"  <?= $mob_check; ?>/>
                                            <label class="list-group-item" for="Radio1">Mobility Mea</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12 pl-0">
                                            <input type="radio" name="is_customer_role" id="is_customer_role_2" value="1" id="Radio2" <?= $cust_check; ?>/>
                                            <label class="list-group-item" for="Radio2">Business customer</label>
                                        </div>
                                    </div>-->
                                </div>

                                <!--<div class="form-group row">
								<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="custom-control custom-radio">
								<input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
								<label for="customRadio1" class="custom-control-label">Mobility Mea Role</label>
								</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="custom-control custom-radio">
								<input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
								<label for="customRadio2" class="custom-control-label">Customer Role</label>
								</div>
								</div>
								</div>-->

                                <!--<div class="form-group">
                                    <label>Choose customer</label>
                                    <select class="form-control" multiple="multiple"  name="customer_id[]" id="customer_id" data-placeholder="Select Customers">
                                        <option>customer 1</option>
                                        <option>sdfsdf 2</option>
                                        <option>jjj 3</option>
                                    </select>
                                </div>-->
                                <div class="col-lg-12 col-sm-12 col-xs-12">&nbsp;</div>
                                <div class="list-group">
                                    <label for="status">Status </label>
                                    <?php
                                    if (isset($arr_role['status'])) {
                                        $inact_check = ($arr_role['status'] == 0) ? 'checked' : '';
                                        $act_check = ($arr_role['status'] == 1) ? 'checked' : '';
                                    } else {
                                        $inact_check = '';
                                        $act_check = 'checked';
                                    }
                                    ?>
                                    <!--<div class="row">
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" <?= $act_check; ?>>
                                                <label class="form-check-label" for="exampleCheck1">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-6 col-xs-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="status" name="status" <?= $inact_check; ?>>
                                                <label class="form-check-label" for="exampleCheck1">inactive</label>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input <?= $readonly; ?> class="custom-control-input" type="radio" id="status" name="status" value="1" <?= $act_check; ?> checked>
                                                    <label for="status" class="custom-control-label">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input <?= $readonly; ?> class="custom-control-input" type="radio" id="status1" name="status" <?= $inact_check; ?>>
                                                    <label for="status1" class="custom-control-label">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group row">
                                        <label class="col-lg-12 col-sm-12 col-xs-12" for="exampleInputPassword1">Customer option</label>
                                        <div class="col-lg-6 col-sm-6 col-xs-12 pr-0">
                                            <input type="radio" name="is_customer_role" id="is_customer_role_1" value="1" id="Radio1"  <?= $mob_check; ?>/>
                                            <label class="list-group-item" for="Radio1">Mobility Mea</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12 pl-0">
                                            <input type="radio" name="is_customer_role" id="is_customer_role_2" value="1" id="Radio2" <?= $cust_check; ?>/>
                                            <label class="list-group-item" for="Radio2">Business customer</label>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">&nbsp;</div>
                    <?php if ($readonly == '') { ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="box-footer"> <!-- onclick="save_role();" -->
                                <button type="submit" id="role_save" name="role_save"  class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
        <?php if ($id != 0 && $id != '') { ?>
            <div class="row mb-2 pt-3 border-top">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="blue_text"></span>2. Role access
                        <?php if ($readonly == '') { ?>
                            <a class="blue_text font_16" href="<?php base_url(); ?>access/<?= $id; ?>"><i class="fas fa-pencil-alt"></i></a>
                        <?php } ?>
                        <h1>
                            <p class="mt-2">List of access for this role</p>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <?php
                        $arr_access = $arr_role['access'];
                        if (is_array($arr_access) && count($arr_access) != 0) {
                            foreach ($arr_access as $module => $Raccess) {
                        ?>
                                <div class="col-lg-4 col-sm-4 col-xs-12">
                                    <div class="grid_bx_cont">
                                        <div class="expander">
                                            <div class="inner-bit">
                                                <h4><?= $module; ?></h4>
                                                <ul>
                                                    <?php foreach ($Raccess as $access_name) { ?>
                                                        <li><?= (isset($access_name['access_name'])) ? $access_name['access_name'] : ''; ?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php if (count($Raccess) > 5) { ?>
                                            <button class="button expand-toggle btn btn-success text-right" href="javascript:void(0)">Show more</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="box-footer">
                                No Access defined for this role
                            </div>
                        <?php
                        }
                        ?>
                        <!--<div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="box-footer">

                            <button type="button" id="role_save" class="btn btn-primary">Save</button>
                        </div>
                    </div>-->
                    </div>
                </div>

                <!-- /.col -->
            </div>
        <?php } ?>
    </div>
</div>
<?= $this->include('templates/footer') ?>
<script>
    $(document).ready(function() {
        $('#customer_id').select2();
    });

    $("#form_role").validate({
                ignore: [],
                debug: false,
                rules: {
                    name: "required",
                    description: "required"
            },
            messages: {
                name: "please enter role name",
                description: "please enter role description"
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
                var status = $("input[name=status]:checked").val();
                var is_customer_role = $("input[name=is_customer_role]:checked").val();
                var params = $('#form_role').serializeArray();
                params.push({
                    'name': 'is_customer_role',
                    'value': is_customer_role
                });
                params.push({
                    'name': 'status',
                    'value': status
                });
                console.log(params);
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "role/save_role",
                    data: params,
                    success: function(response) {
                        if(response.status==true){
                            success_message(response.message, response.redirect_url);
                        }else{
                            error_message(response.message, response.redirect_url);
                        }
                        
                    }
                });

                    
            }
        });

    // save role details
    function save_role() {
        
        /*
        var status = $("input[name=status]:checked").val();
        var is_customer_role = $("input[name=is_customer_role]:checked").val();
        var params = $('#form_role').serializeArray();
        params.push({
            'name': 'is_customer_role',
            'value': is_customer_role
        });
        params.push({
            'name': 'status',
            'value': status
        });
        console.log(params);
        $.ajax({
            type: "POST",
            url: BASE_URL + "role/save_role",
            data: params,
            success: function(response) {
                if(response.status==true){
                    success_message(response.message, response.redirect_url);
                }else{
                    error_message(response.message, response.redirect_url);
                }
                
            }
        });
        */

    }
</script>
<script>
    // multiple expanding content areas

    $(".expand-toggle").click(function(e) {
        e.preventDefault();

        var $this = $(this);
        var expandHeight = $this.prev().find(".inner-bit").height();

        if ($this.prev().hasClass("expanded")) {
            $this.prev().removeClass("expanded");
            $this.prev().attr("style", "");
            $this.html("Show more");
        } else {
            $this.prev().addClass("expanded");
            $this.prev().css("max-height", expandHeight);
            $this.html("Show less");
        }
    });
</script>
<?= $this->endSection() ?>