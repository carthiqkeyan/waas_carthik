<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;
use App\Models\LoginModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use CodeIgniter\Validation\Exceptions\ValidationException;

// use App\Models\CustomerModel;
// use App\Models\UserModel;
// use App\Models\LoginModel;
 use CodeIgniter\API\ResponseTrait;
// use CodeIgniter\RESTful\ResourceController;
// use Exception;
// use \Firebase\JWT\JWT;
// use CodeIgniter\HTTP\IncomingRequest;
// use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\Validation\Exceptions\ValidationException;
// use Config\Services;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Api extends BaseController
{

    use ResponseTrait;

     public function __construct(){

    }
  
      public function index()
    {
        $model = new CustomerModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function generate_token()
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[3]|max_length[255]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

       $input = $this->getRequestInput($this->request);


        // if (!$this->validateRequest($input, $rules, $errors)) {
        //     return $this
        //         ->getResponse(
        //             $this->validator->getErrors(),
        //             ResponseInterface::HTTP_BAD_REQUEST
        //         );
        // }
        return $this ->getJWTForUser($input['email'],ResponseInterface::HTTP_CREATED);

       // return $this->getJWTForUser($input['email']);

       // $email=$this->request->getVar("email");
       // $password=$this->request->getVar("password");
       // $model = new LoginModel();
       // $userdata = $model->authenticate_user($email,$password);

       //  if (!empty($userdata)) {

        
       //          $key = $this->getKey();

       //          $iat = time();
       //          $nbf = $iat + 10;
       //          $exp = $iat + 3600;

       //          $payload = array(
       //              "iss" => "The_claim",
       //              "aud" => "The_Aud",
       //              "iat" => $iat,
       //              "nbf" => $nbf,
       //              "exp" => $exp,
       //              "data" => $userdata,
       //          );

       //          $token = JWT::encode($payload, $key);



       //          $response = [
       //              'status' => 200,
       //              'error' => FALSE,
       //              'messages' => 'User logged In successfully',
       //              'token' => $token,
       //              'data' =>$userdata,
       //          ];
       //          return $this->respondCreated($response);
       //      } else {

       //          $response = [
       //              'status' => 500,
       //              'error' => TRUE,
       //              'messages' => 'Incorrect details'
       //          ];
       //          return $this->respondCreated($response);
       //      }
        
       
    }


    public function auth_user()
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[3]|max_length[255]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

       $input = $this->getRequestInput($this->request);

         $model = new LoginModel();
        $userdata = $model->authenticate_user($input['email'],$input['password']);
         if(!empty($userdata)){

            return $this->getJWTForUser($input['email']);
         }
         else
         {
             $response = [
                    'status' => 500,
                    'error' => TRUE,
                    'messages' => 'Incorrect details'
                ];
                return $this->respondCreated($response);
         }

    }

    function role_access(){

        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[3]|max_length[255]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

       $input = $this->getRequestInput($this->request);

       if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
            }

       $model = new LoginModel();
       $userdata = $model->authenticate_user($input['email'],$input['password']);

        if (!empty($userdata)) {


                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'User logged In successfully',
                    // 'token' => $token,
                    'data' =>$userdata,
                ];
                return $this->respondCreated($response);
            } else {

                $response = [
                    'status' => 500,
                    'error' => TRUE,
                    'messages' => 'Incorrect details'
                ];
                return $this->respondCreated($response);
            }
       

  }

    public function customer_list()
    {
  
        $id =  $this->request->getVar("id");

         $rules = [
            'id' => 'required',
        ];

        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }


                 $model = new CustomerModel();
                 $data = $model->where('customer_parent',$id)->findAll();

                 if (is_array($data)) {

                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Customer list',
                    'data' => $data
                ];
                return $this->respondCreated($response);
            }
            else{

            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }

    }
    public function branch_list()
    { 

        $customer_id=$this->request->getVar("customer_id");

                  $model = new CustomerModel();
                  $data = $model->branch_details($customer_id);

                 if (is_array($data)) {

                 $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Branch list',
                    'data' => $data
                ];
                return $this->respondCreated($response);
            }
        else  {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Access denied'
            ];
            return $this->respondCreated($response);
        }

    }


    private function getKey()
    {

        return "my_application_secret";
    }

 
}
