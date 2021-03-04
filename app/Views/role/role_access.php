<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<?php 
// echo BASE_URL."<br>";exit;
// print_r($access);exit;
$arr_tab_icons = array("account-management"=>" fa-user-circle",
    "advertisement-management"=>" fa-ad",
    "audience-management"=>" fa-users",
    "authorization"=>" fa-key",
    "branch-management"=>" fa-store-alt",
    "campaign-management"=>" fa-mail-bulk",
    "dashboard-management"=>" fa-tachometer-alt",
    "license-management"=>" fa-wifi",
    "reports"=>" fa-chart-bar",
    "subscription-management"=>" fa-calendar-alt",
    "user-management"=>" fa-user-friends",
    "role-management"=>" fa-user-tag",
    "splash-screen-management"=>" fa-photo-video");
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3 border-bottom pb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Role Access</h1>
                <small>Select Role Access for all the modules in the system</small>
                <input type="hidden" name="role_id" id="role_id" value="<?= $role_id;?>"/>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL;?>role/edit/<?= $role_id;?>">Role</a></li>
                    <li class="breadcrumb-item active">Access</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php 
                $active_module_name = '';
                if (is_array($arr_modules) && count($arr_modules) != 0){ ?>
                <?php foreach ($arr_modules as $key=>$module_name) : 
                    $str_module_name = strtolower(str_replace(" ", "-", $module_name));
                    $tab_icon = $arr_tab_icons[$str_module_name];
                    if(isset($ACCESS[$str_module_name]) || isset($_SESSION['role_name'])){
                        if($active_module_name=='') $active_module_name = $str_module_name;
                ?>
                    
                    <a class="nav-link <?php if ($str_module_name == $active_module_name) {
                                            echo 'active';
                                        } ?>" id="v-pills-<?= $str_module_name; ?>-tab" data-toggle="pill" href="#v-pills-<?= $str_module_name; ?>" role="tab" aria-controls="v-pills-<?= $str_module_name; ?>" aria-selected="true"> <i class="fa <?= $tab_icon;?>"></i> &nbsp; <?= $module_name ?></a>
                <?php 
                    }
                endforeach ?>
                 <?php }
                
                  ?>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
            <?php if (is_array($modules) && count($modules) != 0){ ?>
                <?php foreach ($modules as $module_name=>$module) :
                    $str_module_name = strtolower(str_replace(" ", "-", $module_name));
                    $ACCESS_MENU = isset($ACCESS[$str_module_name])?$ACCESS[$str_module_name]:'';
                    $module_id = $module['details']['id'];
                    $role_access = array();
                    $arr_access=array();
                    $role_access = $module['access'];
                    if(isset($access[$module_name])){
                        if(is_array($access[$module_name]['access_ids'])){
                            $arr_access = $access[$module_name]['access_ids'];
                        }
                    }
                    if((is_array($ACCESS_MENU)&& count($ACCESS_MENU)!=0) || isset($_SESSION['role_name'])){
                ?>
                    <div class="tab-pane fade <?php if ($str_module_name == $active_module_name) {echo 'show active';} ?> " " id="v-pills-<?= $str_module_name; ?>" role="tabpanel" aria-labelledby="v-pills-<?= $str_module_name; ?>-tab">
                        <form name="form-<?= $str_module_name; ?>" id="form-<?= $str_module_name; ?>" method="POST">
                            <table class="table-responsive table" id="account_table" cellpadding="5px" width="100%">
                                <tr>
                                    <th><input value=1 type="checkbox" id="<?= $str_module_name; ?>-selectall" name="<?= $str_module_name; ?>-selectall" class="regular-checkbox" onclick="select_all('<?= $str_module_name; ?>')" /><label for="<?= $str_module_name; ?>-selectall"></th>
                                    <th>Select All</th>
                                    <th>&nbsp;</th>
                                    <?php if(count($arr_access)!=0){ ?>
                                        <th>&nbsp;</th>
                                        <th>
                                            <a href="#" onclick="remove_role_access('<?= $str_module_name; ?>','<?= $module_id; ?>');" id="<?= $str_module_name; ?>-remove" name="<?= $str_module_name; ?>-remove" class="btn btn-primary w-100"><i class='fa fa-undo'></i> &nbsp;  Revoke Access </a>
                                        </th>
                                    <?php }else{
                                        echo "<th colspan='2'>&nbsp;</th>";
                                    } ?>
                                </tr>
                                <tr>
                                <?php
                                if (is_array($role_access) && count($role_access) != 0) {
                                    foreach ($role_access as $key => $Raccess) {
                                       if((is_array($ACCESS_MENU) && in_array($Raccess['menu_access'],$ACCESS_MENU)) || isset($_SESSION['role_name'])){
                                        $access_id = (isset($Raccess['id']))?$Raccess['id']:'';
                                        $acc_checked = (count($arr_access)!=0 && in_array($access_id,$arr_access))?'checked':'';
                                        ?>
                                        <td width="20" align="center">
                                            <input <?= $acc_checked;?> type="checkbox" name="<?= $str_module_name; ?>-check-box[]" class="regular-checkbox name" value='<?= $access_id; ?>' id="<?= $str_module_name; ?>-<?= $access_id; ?>" onclick="deselect_selectall('<?= $str_module_name; ?>')" /><label for="checkbox-1-1"></label>
                                        </td>
                                        <td>
                                            <h4><?= $Raccess['name'] ?></h4>
                                            <p><?= $Raccess['description'];?></p>
                                        </td>
                                        <td>&nbsp;</td>
                                            <?php if($key % 2 == 1){ ?>
                                            </tr>
                                        <?php } ?>
                                <?php
                                    }
                                }
                                }
                                ?>

                            </table>
                        
                   
                        <div class="box-footer">
                            <button type="button" id="<?= $str_module_name; ?>-submit" name="<?= $str_module_name; ?>-submit" class="btn btn-primary " onclick="save_role_access('<?= $str_module_name; ?>','<?= $module_id; ?>');">Save</button>
                            <!--<button type="button" id="<?= $str_module_name; ?>-skip" name="<?= $str_module_name; ?>-skip" class="btn btn-primary" onclick="enable_next_tab();">Skip</button>-->
                            <a href="<?= BASE_URL;?>role/edit/<?= $role_id;?>" id="<?= $str_module_name; ?>-back" name="<?= $str_module_name; ?>-back" class="btn btn-primary w-25" >Back to Role </a>
                        </div>
                        </form>
                    </div>
                <?php 
                    }
                endforeach ?>
               
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->include('templates/footer') ?>
<script type="text/javascript">
$(document).ready(function() {
    /*disable non active tabs*/
    // $('.nav a').not('.active').addClass('disabled');
    // /*to actually disable clicking the bootstrap tab, as noticed in comments by user3067524*/
    // $('.nav a').not('.active').find('a').removeAttr("data-toggle");
});

// select/de-select for the module
function select_all(module){
    var set_checked = ($('#'+module+'-selectall').is(":checked"))?true:false;
    $("input[name='"+module+"-check-box[]']").prop("checked",set_checked);
}

// deselect select all check box as required
function deselect_selectall(module_name){
    var box_leng = $("input[name='"+module_name+"-check-box[]']").length;
    var check_box_leng = $("input[name='"+module_name+"-check-box[]']:checked").length;
    if(box_leng != check_box_leng){
        $("input[name='"+module_name+"-selectall']").prop("checked",false);
    }else{
        $("input[name='"+module_name+"-selectall']").prop("checked",true);
    }
}

// function to enable the next tab and open it
function enable_next_tab(){
    // $('.nav a.active').next('a').removeClass('disabled'); // to remove the disabled class from tab
    $('.nav a.active').next('a').click(); // open next tab
    $('.nav a.active').prev('a').removeClass('active');
    // $('.nav a.active').next('a').find('a').attr("data-toggle","tab");
    // $('.nav a.active').prev('a').addClass('active'); // set next tab active
    
}

// function to save role access for an module
function save_role_access(module_name,module_id){
    // alert(form_name +" ---- "+module_id);
    var role_id = $('#role_id').val();
    var form_name = 'form-'+module_name;
    var params = $('#'+form_name).serializeArray();
    params.push({'name':'module_id','value':module_id});
    params.push({'name':'role_id','value':role_id});
    params.push({'name':'module_name','value':module_name});
    var check_box_leng = $("input[name='"+module_name+"-check-box[]']:checked").length;
    // alert(check_box_leng);
    // console.log(params);
    if(check_box_leng==0){
        alert('Kindly select at-least one access for the role');
    }else{
        $.ajax({
            type: "POST",
            url:BASE_URL+"role/save_access",
            data:params,
            success: function(response) {
                console.log(response);
                //alert(response.message);
                success_message(response.message);
                if(response.status==true){
                    enable_next_tab();
                   // window.reload();
                }
            }
        });
    }
}

// function to remove access to a module
function remove_role_access(module_name,module_id){
    var role_id = $('#role_id').val();
    var params = [];
    params.push({
        'name': 'role_id',
        'value': role_id
    });
    params.push({
        'name': 'module_id',
        'value': module_id
    });
    params.push({
        'name': 'flag',
        'value': true
    });
    var action_url = BASE_URL + "role/delete_access";
    delete_confirmation_message(params, action_url);

    // alert(form_name +" ---- "+module_id);
    /*
    $.ajax({
        type: "POST",
        url:BASE_URL+"/role/delete_access/"+role_id+"/"+module_id,
        data:params,
        success: function(response) {
            console.log(response);
            //alert(response.message);
            // success_message(response.message);
            // if(response.status==true){
            //     enable_next_tab();
            // }
        }
    });*/
    
}

    
</script>
<?= $this->endSection() ?>