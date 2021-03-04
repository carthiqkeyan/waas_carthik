<?php 

namespace App\Models;

use CodeIgniter\Model;
// $db = \Config\Database::connect();

class RoleAccessModel extends Model
{
    protected $table      = 'system_role_access';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','role_id','module_id','access_id','access_right'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $skipValidation     = false;
    protected $validationRules    = [];

    protected $validationMessages = [];

    public function get_role_access($role_id){

    }
}