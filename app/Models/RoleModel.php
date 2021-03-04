<?php 

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'system_roles';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','name','description','status','customer_id','is_customer_role'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $skipValidation     = false;

    protected $validationRules    = [
        'name'     => 'required|alpha_numeric_space|min_length[3]',
        'description'  => 'required|alpha_numeric_space|min_length[2]',
        'status'     => 'required',
        'is_customer_role' => 'required'
    ];

    protected $validationMessages =[
        'name' => ' Role Name is required ',
        'description' => ' Role description is required ',
        'status' => ' Role status is required ',
        'is_customer_role' => ' Role Name is required '
    ];


    public function get_role_access($role_id){
		$role_access = array();
        $builder = $this->db->table('system_role_access');
        $builder->select('role_id,system_role_access.module_id,system_role_access.access_id,access_right,system_modules.name as module_name, system_module_access.name as access_name');
        $builder->join('system_modules', 'system_role_access.module_id = system_modules.id','left');
        $builder->join('system_module_access', 'system_role_access.access_id = system_module_access.id','left');
        $builder->where('system_role_access.role_id',$role_id);
        // $builder->groupBy('system_role_access.module_id');
        //$builder->groupBy('system_modules.name as module_name');
        $query = $builder->get();
        $arr_access = $query->getResultArray();
        if(is_array($arr_access) && count($arr_access)!=0){
            foreach($arr_access as $access){
                $module_name = $access['module_name'];
                $role_access[$module_name][] = $access;
                $role_access[$module_name]['access_ids'][] = $access['access_id'];
            }
        }
        // print_r($role_access);
        return $role_access;
        // print_r($role_access);
    }
 
    public function get_role_details($role_id){
        $arr_role = $this->find($role_id);
        if($role_id!=0){
            $arr_role['access'] = $this->get_role_access($role_id);
        }
        return $arr_role;
    }
    
    public function get_role_editdetails($role_id){
    if($role_id) {
        $sql = "SELECT * FROM system_roles WHERE id = ?";
        $this->query($sql,$role_id);
        $query = $this->query($sql,$role_id);
        return $query->row_array();
    }
    }

    public function save_role(){
        $data = $this->request->getPost();
        $this->insert($data);
        print_r ($this->insertID());
    }
   
    public function get_role_modules(){
        $query = $this->db->query('SELECT * FROM system_modules where status=1 AND is_active=1');
        $results = $query->getResult();  
        return $results;
        // if(is_array($arr_modules) && count($arr_)){

        // }
        // $data['modules'] = $arr_modules;
    }

//  public function delete_data($role_id){
//   //$arr_role = $table->delete($role_id);
//   echo "test id".$role_id;
//   exit();
//  $data = $db->query('DELETE FROM system_roles WHERE id="'.$role_id.'"');
//  return $data;
//  }
}
?>