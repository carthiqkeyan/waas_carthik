<?php

namespace App\Controllers;

use App\Models\RoleAccessModel;

class RoleAccess extends BaseController{

    protected $db = "";

    public function __construct(){
        $this->obj_roleaccessModel = new RoleAccessModel();
        $this->db = \Config\Database::connect();
    }

	public function index(){
       // echo "test";
        $obj_roleaccessModel = new RoleAccessModel();
        $arr_roles = $obj_roleaccessModel->findAll($limit=0,$offset=25);
        $data['arr_roles'] = $arr_roles;
       // echo $results;
		return view('role/list',$data);
    }

    public function save_role_access(){
        print_r($_REQUEST);
    }

   
    
}
?>