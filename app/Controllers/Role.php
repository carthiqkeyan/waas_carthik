<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\SystemModuleModel;
use App\Models\RoleModel;
use App\Models\RoleAccessModel;

class Role extends BaseController{

    protected $db;

    public function __construct(){
        $this->obj_roleModel = new RoleModel();
    }


    /**
     * Add and edit role
     */
    public function addedit($id=0){ 
        // $obj_customer = new CustomerModel();
        // $arr_customers = $obj_customer->findAll($limit=0,$offset=25);

         if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
        { 
         
           if (isset($_SESSION['role_name']) || isset($_SESSION['role-management'])) {

        if($id != ""){  
            // echo "Edit role";exit;
            $data['arr_role'] = $this->obj_roleModel->get_role_details($id);
            // echo json_encode($arr_role);
            // return view('role/edit',$data); 
            $data['id'] = $id; 
            $data['table_title'] = " Roles Edit";
            $data['page_title'] = " Role : Edit";
        }else {
            $data = $this->request->getPost();
            $data['id'] = 0;
            $data['table_title'] = " Roles Add";
            $data['page_title'] = " Role : Add";
        }
        $data['readonly'] = "";
        $data['ACCESS'] = $this->action_access;
        $data['action_access'] = isset($this->action_access['role-management'])?$this->action_access['role-management']:$this->action_access;
        return view('role/add',$data);

         }
        else
        {
           return view('templates/error');
        }

        }

        else 
      {
     $data['page_title'] = " Admin : Login ";
      return view('login',$data);     
      }

    }

     /**
     * Add and edit role
     */
    public function view_role($id=0){ 
        // $obj_customer = new CustomerModel();
        // $arr_customers = $obj_customer->findAll($limit=0,$offset=25);
        if($id != ""){  
            // echo "Edit role";exit;
            $data['arr_role'] = $this->obj_roleModel->get_role_details($id);
            // echo json_encode($arr_role);
            // return view('role/edit',$data); 
            $data['id'] = $id; 
            $data['table_title'] = " Roles Edit";
            $data['page_title'] = " Role : Edit";
        }
        $data['readonly'] = "disabled";
        $data['action_access'] = isset($this->action_access['role-management'])?$this->action_access['role-management']:$this->action_access;
        return view('role/add',$data);
    }

    /**
     * function to list all the roles
     **/
    public function list_roles(){
         if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 

         if (isset($_SESSION['role_name']) || isset($_SESSION['role-management'])) {

        $role_id = $this->session->get('role_id');
        $module_id = $this->session->get('role-management');
        $customer_id = $this->session->get('customer_id');

        $arr_access = $this->module_access_list($role_id,$module_id);
        if($customer_id!=0 && $customer_id!=0){
            $arr_roles = $this->obj_roleModel
                              ->where('customer_id',$customer_id)
                              ->where('is_customer_role!=',0)

                              ->orderBy('id', 'DESC')->findAll();    
        }else{
            $arr_roles = $this->obj_roleModel->orderBy('id', 'DESC')->findAll();
        }
        $data['ROLE_NAMES'] = array('Mobility Mea Role','Customer Role','Branch Role');
        $data['arr_roles'] = $arr_roles;
        $data['table_title'] = " Roles List";
        $data['page_title'] = " Role : List";
        $data['action_access'] = isset($this->action_access['role-management'])?$this->action_access['role-management']:$this->action_access;

		return view('role/list',$data);

        }
        else
        {
           return view('templates/error');
        }
      
      }

        else 
    {
    $data['page_title'] = " Admin : Login ";
      return view('login',$data);     
    }
    
    }

    // function to save role details
    public function save_role(){
        $output = array();
        // $obj_roleModel = new RoleModel();
        $data = $this->request->getPost();
        $record = [
            'name' => $data['name'],
            'description' => $data['description'],
            'id' => ($data['id']=='')?0:$data['id'],
            'status' => ($data['status']=='')?0:$data['status'],
            'is_customer_role' => $data['is_customer_role'],
            'customer_id'=>$_SESSION['customer_id'],
            'is_active' => 1
            ];
        $this->obj_roleModel->save($record);
        $role_id = ($data['id']==0)? $this->db->insertID():$data['id'];
        $redirect_url = ($data['id']==0)?'role/edit/access/'.$role_id:"";
        if($role_id!=0){
            $output = [
                'status' => true,
                'message' => 'Role saved successfully',
                'role_id' => $role_id,
                'redirect_url'=>'role/edit/access/'.$role_id
            ];
        }else{
            $output = [
                'status' => false,
                'message' => "Error trying to save role",
                'role_id' => $role_id,
                'redirect_url'=>''
            ];
        }
        return $this->response->setJSON($output);
    }

    // delete role 
    public function delete_role(){
        $data = $this->request->getPost();
        if(is_array($data)){
            $role_id = $data['id'];
        }
        if($role_id!='' && $role_id!=0){
            $obj_roleModel = new RoleModel();
            $this->obj_roleModel->delete($role_id);
            $output = [
             'status' => true,
             'message' => 'Role Deleted Successfully!'
          ];
        }else{
            $output = [
                'status' => false,
                'message' => 'Error when trying to delete a role'
             ];
        }
      return $this->response->setJSON($output);
    }

    // show role access pages
    public function show_role_access($role_id){
        $obj_systemModule = new SystemModuleModel();
        $arr_modules = $obj_systemModule->get_modules();
        $data['modules'] = $arr_modules;
        $data['arr_modules'] = array_keys($arr_modules);
        $data['role_id'] = $role_id;
        $data['access'] = $this->obj_roleModel->get_role_access($role_id);
        $data['table_title'] = " Roles Access";
        $data['page_title'] = " Role >> Access";
        $data['ACCESS'] = $this->action_access;
        return view('role/role_access',$data);
    }

    // delete access rights of a module
    public function delete_role_access(){
        $data = $this->request->getPost();
        if(is_array($data)){
            $role_id = $data['role_id'];
            $module_id = $data['module_id'];
            $flag = isset($data['flag'])?$data['flag']:false;
        }
        if($module_id!=0 && $role_id!=0){
            $obj_roleaccessModel = new RoleAccessModel();
            $obj_roleaccessModel->where('role_id',$role_id)->where('module_id',$module_id)->delete();
            $output = [
                'status' => true,
                'message' => 'Access for this module has been revoked'
            ];
        }else{
            $output = [
                'status' => false,
                'message' => 'error when trying to delete access for the module'
            ];
        } 
        if($flag==true)  {
            return $this->response->setJSON($output);
        }
    }

    // save module's access right for a role
    public function save_role_access(){
        $obj_roleaccessModel = new RoleAccessModel();
        $data = $this->request->getPost();
        $module = $data['module_name'];
        $arr_access = $_REQUEST[$module."-check-box"];
        $this->delete_role_access();
        if(is_array($arr_access) && count($arr_access)!=0){
            foreach($arr_access as $access_id){
            $record = [
                'module_id' => $data['module_id'],
                'role_id' => $data['role_id'],
                'access_id' => $access_id,
                'access_right' => 1
            ];
            $obj_roleaccessModel->save($record);
            }
        $output = [
            'status' => true,
            'message' => 'Module access saved successfully'
        ];
        }else{
        $output = [
            'status' => false,
            'message' => 'No access selected for the module'
        ];
        }
        return $this->response->setJSON($output);
    }  
}
?>