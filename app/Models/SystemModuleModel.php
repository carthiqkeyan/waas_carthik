<?php 

namespace App\Models;

use CodeIgniter\Model;
// $db = \Config\Database::connect();

class SystemModuleModel extends Model
{
    protected $table      = 'system_modules';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $useSoftDeletes = false;

    protected $allowedFields = [];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $skipValidation     = false;
    protected $validationRules    = [];

    protected $validationMessages = [];

   
    /**
     * function to get all active modules in the system
     * 
     */
    public function get_modules(){
        $arr_access = array();
        $where = array('status'=>1,'is_active'=>1);
        // $arr_modules = $this->select('id, name, description')->where('status',1)->where('is_active',1)->findAll();
        $query = $this->db->query('SELECT id, name, description,menu_access FROM system_modules where status=1 AND is_active=1 order by name asc');
        $arr_modules = $query->getResultArray();  
        if(is_array($arr_modules) && count($arr_modules)){
            foreach($arr_modules as $module){
                $module_id = $module['id'];
                $module_name = $module['name'];
                $arr_access[$module_name]['details'] =  $module;
                $arr_access[$module_name]['access'] = $this->get_module_access($module_id);
            }
        }
        return $arr_access;
    }

    /**
     * function to get all access for a module
     * @param module_id
     * return array of access for the module_id sent
     */
    public function get_module_access($module_id){
        $query = $this->db->query('SELECT id, name, description,menu_access FROM system_module_access where module_id='.$module_id.' AND status=1 AND is_active=1');
        $results = $query->getResultArray();  
        return $results;
    }

}
