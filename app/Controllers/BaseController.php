<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\Services;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Validation\Exceptions\ValidationException;
use Config\Services;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	 /**
     * @var string
     * Holds the session instance
     */
	protected $session;
	
	 /**
     * @var string
     * Holds the session instance
     */
	protected $db;
	
	protected $action_access;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// Ensure that the session is started and running
		if (session_status() == PHP_SESSION_NONE )
		{
			$this->session = Services::session();
		}
		$this->db = \Config\Database::connect();
		// $this->obj_role_model = RoleModel(); // Role Model
		$role_id = $this->session->get('role_id');
		$this->action_access = $this->module_access_list($role_id);
	}

	public function getResponse(array $responseBody,
                                int $code = ResponseInterface::HTTP_OK)
    {
        return $this
            ->response
            ->setStatusCode($code)
            ->setJSON($responseBody);
    }

    public function getRequestInput(IncomingRequest $request){
        $input = $request->getPost();
        if (empty($input)) {
            //convert request body to associative array
            $input = json_decode($request->getBody(), true);
        }
        return $input;
    }

    public function validateRequest($input, array $rules, array $messages = []){
        $this->validator = Services::Validation()->setRules($rules);
        // If you replace the $rules array with the name of the group
        if (is_string($rules)) {
            $validation = config('Validation');

            // If the rule wasn't found in the \Config\Validation, we
            // should throw an exception so the developer can find it.
            if (!isset($validation->$rules)) {
                throw ValidationException::forRuleNotFound($rules);
            }

            // If no error message is defined, use the error message in the Config\Validation file
            if (!$messages) {
                $errorName = $rules . '_errors';
                $messages = $validation->$errorName ?? [];
            }

            $rules = $validation->$rules;
        }
        return $this->validator->setRules($rules, $messages)->run($input);
    }

	public function check_menu_access($role_id,$module_id,$action){
		$builder = $this->db->table('system_role_access');
		$builder->select('system_module_access.name as access_name,system_module_access.menu_access');
		$builder->join('system_module_access', 'system_role_access.access_id = system_module_access.id','left');
		$builder->where('system_role_access.role_id',$role_id);
		$builder->where('system_role_access.module_id',$module_id);
		$builder->where('system_module_access.menu_access',$action);
		$query = $builder->get();
		$arr_action_access = $query->getResultArray();
		return (is_array($arr_action_access) && count($arr_action_access)!=0)? true: false;
	}


	// function that fetches the module access details for a role
    public function module_access_list($role_id,$module_id=0){
		$arr_list =  array();
		if($role_id!=0){
			$builder = $this->db->table('system_role_access');
			$builder->select('system_module_access.menu_access,system_role_access.module_id,system_modules.menu_access as module_menu_name');
			$builder->join('system_module_access', 'system_role_access.access_id = system_module_access.id','left');
			$builder->join('system_modules', 'system_role_access.module_id = system_modules.id','left');
			$builder->where('system_role_access.role_id',$role_id);
			$builder->where('system_role_access.access_right',1);
			if($module_id!=0 && $module_id!=''){
				$builder->where('system_role_access.module_id',$module_id);
			}
			$query = $builder->get();
			$arr_action_access = $query->getResultArray();
			// echo $this->db->getLastQuery()."<br>";
			// print_r($arr_action_access);
			if(is_array($arr_action_access)&& count($arr_action_access)!=0){
				foreach($arr_action_access as $access){
					$sel_module_name = $access['module_menu_name'];
					$arr_list[$sel_module_name][] = $access['menu_access'];
				}
			}
		}else{
			$arr_list = unserialize(ACCESS_RIGHTS);
			// $arr_list = "SUPER_ADMIN";
			// print_r($arr_list);
		}
		return $arr_list;
	}




}
