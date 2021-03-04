<?php 

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
     protected $table = 'admin_users';
 
    protected $allowedFields = ['id','name','email','password','status'];

     protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $skipValidation     = false;
    protected $validationRules    = [];

    protected $validationMessages = [];

     protected $session;

    function __construct()
     {

    //     $this->session = \Config\Services::session();
    //     $this->session->start();

      parent::__construct();
      // print_r($this->db);
   }

 function auth($username,$password){

   //  $this->session = \Config\Services::session();

 	  $password =md5($password);

    $qry = $this->db->query("SELECT id,name,email,password,status FROM admin_users WHERE  password = '{$password}' AND status=1 AND is_active=1 AND (email = '$username')");
         $result = $qry->getRow();
          if ($result) {
             $id=$result->id;
             $name=$result->name;
             $email=$result->email;

            $this->session->set('id',$id);
            $this->session->set('name',$name);
            $this->session->set('email',$email);

            $response['status'] = 1;
            $response['message'] = "Login successfully";
	        } 
	        else{
	         $response['status'] = 0;
	         $response['message'] = "Failed !";
	        }

        return $response;
    }

    // function that fetches the module access details for a role
    public function role_module_access($role_id,$customer_id,$sess_flag=false){
        $arr_access = array();
        $builder = $this->db->table('system_role_access');
        $builder->select('role_id,system_role_access.module_id,system_modules.name as module_name,system_modules.menu_access');
        $builder->join('system_modules', 'system_role_access.module_id = system_modules.id','left');
        $builder->where('system_role_access.role_id',$role_id);
        $builder->groupBy("system_role_access.module_id");
        $builder->where('system_role_access.access_right',1);
        // $builder->where('system_role.customer_id',$customer_id);
        $query = $builder->get();
        // echo $this->db->getLastQuery()."<br>";
        $arr_mod_access = $query->getResultArray();
        if(is_array($arr_mod_access) && count($arr_mod_access)!=0){
           foreach($arr_mod_access as $mod_access){
              $module_id = $mod_access['module_id'];
              $module_name = trim($mod_access['module_name']);
              $menu_access = trim($mod_access['menu_access']);
            //$module_name = (count(explode(" ",$module_name))>=2)?strtolower(str_replace(" ", "-", $module_name)):strtolower($module_name);
              $arr_access[$module_id] = $module_name;
              if($sess_flag== true){
                  $this->session->set($menu_access, $module_id);
                  $this->session->set('is_logged_in',true);

              }
           }
        }
        return $arr_access;
    }

    // function that fetches the module access details for a role
    public function module_access($role_id,$module_id){
      $builder = $this->db->table('system_role_access');
      $builder->select('system_module_access.name as access_name,system_module_access.menu_access');
      $builder->join('system_module_access', 'system_role_access.access_id = system_module_access.id','left');
      $builder->where('system_role_access.role_id',$role_id);
      $builder->where('system_role_access.module_id',$module_id);
      $builder->where('system_role_access.access_right',1);
      $query = $builder->get();
      $arr_action_access = $query->getResultArray();
      return $arr_action_access;
  }

   // function to check users 
   public function authenticate_user($email,$password){
      $this->session = session();
      if($email!='' && $password!=''){
         $builder = $this->db->table('system_users');
         $builder->where('email',$email);
         $password = md5($password);
         $builder->where('password',$password);
         $builder->where('status',1);
         $builder->where('is_active',1);
         $query = $builder->get();
         $arr_user = $query->getResultArray();
         if(is_array($arr_user) && count($arr_user)!=0){
            $arr_user = $arr_user[0];
            // print_r($arr_user);exit;
            $role_id = $arr_user['role_id'];
            $customer_id = $arr_user['customer_id'];
            $arr_user['is_logged_in'] = true;
            $this->session->set($arr_user);
            if($role_id==0 && $customer_id==0){
               $this->session->set('role_name','SUPER_ADMIN');
               $module_access ='Super admin';
               // $this->session['role_name'] = "SUPER_ADMIN";
            }else{
               $module_access = $this->role_module_access($role_id,$customer_id,true);
               // $this->session->set('menu_access',$module_access);
            }
            // if($arr_user['role_id']!=0){
            //    $role_id = $arr_user['role_id'];
            //    $customer_id = $arr_user['customer_id'];
            //    $arr_user['module_access'] = $this->role_module_access($arr_user['role_id'],$customer_id);
            // }
            // print_r($_SESSION);
            return $module_access;
         }else{
            return false;
         }
      }else{
         return false;
      }
   }

  
}
