<?php 
namespace App\Controllers;
use App\Models\LoginModel;
use \Firebase\JWT\JWT;


// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class Login extends BaseController
{
  // private $session;

	public function index()
	{
  //  $this->session->destroy();
    if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true){
      return redirect()->to('dashboard');
    }else{
      $data['page_title'] = " Admin : Login ";
      return view('login',$data);
    }
    // if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']==true){
    //   print_r($_SESSION);
    //   return redirect()->to('dashboard'); 
    // }else{
    //   return view('login');
    // }
		
	}

   private function getKey()
    {

        return "my_application_secret";
    }

	public function authenticate(){ 
    
    // $this->session->set('teste','adsasdfasdf');
    // print_r($this->session);exit;
    $data = $this->request->getPost();
    $obj_login = new LoginModel();
    // $this->request->
    // $email = $this->request->postVar('email');
    // $password = $this->request->postVar('password');
    // $response = $LoginModel->auth($email,$password);
    if(is_array($data)&& count($data)!=0){
      $arr_user = $obj_login->authenticate_user($data['email'],$data['password']);

       $key = $this->getKey();

                $iat = time();
                $nbf = $iat + 10;
                $exp = $iat + 3600;

                $payload = array(
                    "iss" => "The_claim",
                    "aud" => "The_Aud",
                    "iat" => $iat,
                    "nbf" => $nbf,
                    "exp" => $exp,
                    "data" => $arr_user,
                );

                $token = JWT::encode($payload, $key);
 
      if(is_array($arr_user)&& count($arr_user)!=0 || !empty($arr_user)){
        $output = [
          'status' => true,
          'token' => $token
        ];
      }else if ($arr_user==false){
        $output = [
          'status' => false,
          'message' => 'Not Unauthorized'
        ];
      }
    }
    return $this->response->setJSON($output);
  }

  public function logout()
  {
    $this->session->destroy();
    return redirect()->to('index.php/login'); 
  }


}