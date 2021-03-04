<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LoginModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;

class Auth extends BaseController
{

    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
//     public function register()
//     {
//         $rules = [
//             'name' => 'required',
//             'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
//             'password' => 'required|min_length[8]|max_length[255]'
//         ];

//  $input = $this->getRequestInput($this->request);
//         if (!$this->validateRequest($input, $rules)) {
//             return $this
//                 ->getResponse(
//                     $this->validator->getErrors(),
//                     ResponseInterface::HTTP_BAD_REQUEST
//                 );
//         }

//         $userModel = new UserModel();
//        $userModel->save($input);
     

       

// return $this
//             ->getJWTForUser(
//                 $input['email'],
//                 ResponseInterface::HTTP_CREATED
//             );

//     }

    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
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


        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $model = new LoginModel();
        $userdata = $model->authenticate_user($input['email'],$input['password']);

       if (!empty($userdata)) {
       return $this->getJWTForUser($input['email']);
        }
        else
        {
            return $this->getResponse(
                    [
                      'status' => 500,
                      'error' => TRUE,
                      'messages' => 'Incorrect details'
                    ]
                );
        }
       
    }

    private function getJWTForUser(
        string $emailAddress,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        try {
            $model = new UserModel();
            $user = $model->findUserByEmailAddress($emailAddress);
            unset($user['password']);

            helper('jwt');

            return $this
                ->getResponse(
                    [   
                        'status' => 200,
                        'message' => 'User authenticated successfully',
                        'user' => $user,
                        'access_token' => getSignedJWTForUser($emailAddress)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}