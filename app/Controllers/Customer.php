<?php
namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\SubscriptionModel;

class Customer extends BaseController{

    protected $db = "";

    public function __construct(){
        $this->obj_roleModel = new CustomerModel();
        $this->db = \Config\Database::connect();
        // $this->security = \Config\Services::security();
    }

    public function index(){

     if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
    { 
    $data['table_title'] = " Customer List";
    $data['page_title'] = " Customer : List";
    return view('customer/list');
    }else 
    {
    $data['page_title'] = " Admin : Login ";
      return view('login',$data);     
    }

    }
  
    public function list(){

       if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 
        if (isset($_SESSION['role_name']) || isset($_SESSION['account-management'])) { 

        $CustomerModel = new CustomerModel();
         $customer_parent =$_SESSION['customer_id'];

           $data['arr_customer'] = $CustomerModel->select('customer_account.*,customer_license.license')->join('customer_license','customer_license.customer_id=customer_account.id','left')->where('customer_account.customer_parent',$customer_parent)->where('customer_account.status!=',0)->where('customer_account.is_active',1)->where('customer_license.status',1)->orderBy('customer_account.id', 'DESC')->findAll();
          
        $data['table_title'] = " Customer List";
        $data['page_title'] = " Customer : List";
        $data['action_access'] = isset($this->action_access['account-management'])?$this->action_access['account-management']:$this->action_access;
         // $data = $this->security->xss_clean($data);
       return view('customer/list',$data);

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

     public function account(){
       if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 

         if (isset($_SESSION['role_name']) || isset($_SESSION['account-management'])) { 

        $SubscriptionModel = new SubscriptionModel();
        $CustomerModel = new CustomerModel();
        $data['id'] = $this->request->uri->getSegment(3);
        $data['arr_subscription'] = $SubscriptionModel->where('customers',$data['id'])->where('status!=',0)->orderBy('id', 'DESC')->findAll();
       $data['billing_details'] =$CustomerModel->billing_details($data['id']);
       $data['license_details'] =$CustomerModel->license_details($data['id']);
       // $data['sms_email_details'] =$CustomerModel->sms_details($data['id']);
       $data['customer_users'] =$CustomerModel->customer_users($data['id']);
       $data['brand_details'] =$CustomerModel->brand_details($data['id']);
       $data['customer_details'] =$CustomerModel->customer_details($data['id']);
       $data['branch_details'] =$CustomerModel->branch_details($data['id']);
       $data['license_count'] =$CustomerModel->customer_License($data['id']);
       $data['branch_count'] =$CustomerModel->branch_count($data['id']);
       $data['active_sub'] =$CustomerModel->active_sub($data['id']);
       $data['arr_role'] =$CustomerModel->get_role(1,$data['id']); // get only customer roles to display
       $data['branch_role'] =$CustomerModel->get_role(2,$data['id']); // get only dranch roles to display
       $data['action_access'] = isset($this->action_access['account-management'])?$this->action_access['account-management']:$this->action_access;
        $data['table_title'] = " Customer List";
        $data['page_title'] = " Customer : List";

        return view('customer/account',$data);
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

     public function my_details(){
      if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 
     $SubscriptionModel = new SubscriptionModel();
     $CustomerModel = new CustomerModel();
     $data['id'] = $_SESSION['customer_id'];
     $data['arr_subscription'] = $SubscriptionModel->where('customers',$data['id'])->where('status',1)->orderBy('id', 'DESC')->findAll();
     $data['billing_details'] =$CustomerModel->billing_details($data['id']);
     $data['customer_details'] =$CustomerModel->customer_details($data['id']);
     $data['license_details'] =$CustomerModel->license_details($data['id']);
     $data['brand_details'] =$CustomerModel->brand_details($data['id']);
     $data['branch_details'] =$CustomerModel->branch_details($data['id']);
     $data['customer_users'] =$CustomerModel->customer_users($data['id']);
     $data['arr_role'] =$CustomerModel->get_role(1,$data['id']); // get only customer roles to display
     $data['branch_role'] =$CustomerModel->get_role(2,$data['id']); // get only dranch roles to display
     $data['table_title'] = " Customer List";
     $data['page_title'] = " Customer : List";

        return view('customer/my_details',$data);

        }
       else 
      {
     $data['page_title'] = " Admin : Login ";
      return view('login',$data);     
      }

    }

    public function view(){
       if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 

         if (isset($_SESSION['role_name']) || isset($_SESSION['account-management'])) { 

      $SubscriptionModel = new SubscriptionModel();
      $CustomerModel = new CustomerModel();
      $data['id'] = $this->request->uri->getSegment(3);
      $data['arr_subscription'] = $SubscriptionModel->where('customers',$data['id'])->where('status',1)->orderBy('id', 'DESC')->findAll();
     $data['billing_details'] =$CustomerModel->billing_details($data['id']);
     $data['customer_details'] =$CustomerModel->customer_details($data['id']);
     $data['license_details'] =$CustomerModel->license_details($data['id']);
     $data['brand_details'] =$CustomerModel->brand_details($data['id']);
     $data['branch_details'] =$CustomerModel->branch_details($data['id']);
     $data['customer_users'] =$CustomerModel->customer_users($data['id']);
     $data['arr_role'] =$CustomerModel->get_role(1,$data['id']); // get only customer roles to display
     $data['branch_role'] =$CustomerModel->get_role(2,$data['id']); // get only dranch roles to display
     $data['table_title'] = " Customer List";
     $data['page_title'] = " Customer : List";
     $data['action_access'] = isset($this->action_access['account-management'])?$this->action_access['account-management']:$this->action_access;

        return view('customer/view',$data);

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

    public function account_save() {
      $CustomerModel = new CustomerModel();
      $response =$CustomerModel->account_save();
      echo json_encode($response);exit; 
     }

    public function user_save() {
      $CustomerModel = new CustomerModel();
      $response =$CustomerModel->user_save();
      echo json_encode($response);exit; 
     }

     public function branch_save() {
      $CustomerModel = new CustomerModel();
      $response =$CustomerModel->branch_save();
      echo json_encode($response);exit; 
     }

     public function subscription(){
     $SubscriptionModel = new SubscriptionModel();
     $data['arr_subscription'] = $SubscriptionModel->where('status',1)->orderBy('id', 'DESC')->findAll();
     return view('customer/subscription',$data);
     }

    public function subscription_save() {
      $SubscriptionModel = new SubscriptionModel();
      $CustomerModel = new CustomerModel();

      $id = $this->request->getVar('id');
      $status = $this->request->getVar('status');

      $data = [
          'start_date'    => $this->request->getVar('start_date'),
          'end_date'      => $this->request->getVar('end_date'),
          'customers'     => $this->request->getVar('cusSub_id'),
          'status'        => $this->request->getVar('status'),
      ];

       $single_sub = $SubscriptionModel->select('*')->where('status!=',0)->where('customers',$id)->find();


        if ($status==2) {
           $result= $SubscriptionModel->insert($data);
           $response['status']=1;
           $response['message']='Success';
           $response['id'] =$id;
        }
        else if (empty($single_sub) && $status=1) {
          $result= $SubscriptionModel->insert($data);
          $response['status']=1;
          $response['message']='Success';
          $response['id'] =$id;
        } 
  
      else{
        $response['status']=0;
        $response['message']='Only one active subscription';
      }

      $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Subscription',
                    "sub_function"=>'Add',
                      );

      $stmt=$CustomerModel->insert_common_action($req_array);

     echo json_encode($response);exit;  
    }

    public function license(){
     $CustomerModel = new CustomerModel();
     $data['id'] = $this->request->uri->getSegment(3);
     $data['license_details'] =$CustomerModel->license_details($data['id']);
        return view('customer/license',$data);
    }

    public function license_save() {
      $CustomerModel = new CustomerModel();
      $response =$CustomerModel->license_save();
     echo json_encode($response);exit; 
    }

    public function sms_save() {
      $CustomerModel = new CustomerModel();
      $response =$CustomerModel->sms_email_save();
     echo json_encode($response);exit; 
    }

    public function billing_details(){
     $CustomerModel = new CustomerModel();
     $data['id'] = $this->request->uri->getSegment(3);
     $data['billing_details'] =$CustomerModel->billing_details($data['id']);
        return view('customer/billing',$data);
    }

    public function single_branch(){
     $CustomerModel = new CustomerModel();
     $response =$CustomerModel->single_branch();
      echo json_encode($response);exit; 
    }

    public function single_user(){
     $CustomerModel = new CustomerModel();
     $response =$CustomerModel->single_user();
      echo json_encode($response);exit; 
    }

    // public function single_branchuser(){
    //  $CustomerModel = new CustomerModel();
    //  $response =$CustomerModel->single_branchuser();
    //   echo json_encode($response);exit; 
    // }

    public function billing_save() {
    $CustomerModel = new CustomerModel();
    $response =$CustomerModel->billing_save();
    echo json_encode($response);exit; 
    }

    public function brand_logo(){
    $CustomerModel = new CustomerModel();
    $data['id'] = $this->request->uri->getSegment(3);
    $data['billing_details'] =$CustomerModel->billing_details($data['id']);
    return view('customer/brand_logo',$data);
    }

    public function brand_save() {
    $CustomerModel = new CustomerModel();
    $response =$CustomerModel->brand_save();
    echo json_encode($response);exit; 
    }

     public function change_password() {
     $CustomerModel = new CustomerModel();
     $data['id'] = $this->request->uri->getSegment(3);
     $response =$CustomerModel->change_password();
     echo json_encode($response);exit; 
    }

     public function sub_delete() {
          $SubscriptionModel = new SubscriptionModel();
           $id = $this->request->uri->getSegment(4);
           $cus_id = $this->request->uri->getSegment(5);
         $data = [
            'status' => '0',
        ];
        $SubscriptionModel->update($id, $data);
        return $this->response->redirect(site_url('customer/account/'.$cus_id));
    }

    public function delete(){
         $data = $this->request->getPost();
        if(is_array($data)){
            $id = $data['id'];
        }
        if($id!='' && $id!=0){
             $CustomerModel = new CustomerModel();
             $data = [
            'status' => '0',
            'is_active' => '0',
              ];

        $CustomerModel->update($id, $data);
            $output = [
             'status' => true,
             'message' => 'Customer Deleted Successfully!'
          ];
        }else{
            $output = [
                'status' => false,
                'message' => 'Error when trying to delete a customer'
             ];
        }
      return $this->response->setJSON($output);
    } 

    public function cus_status(){
        $data = $this->request->getPost();
        if(is_array($data)){
            $id = $data['id'];
            $status=$data['status'];
        }
        if($id!='' && $id!=0){
             $CustomerModel = new CustomerModel();
             $data = [
            'status' => $status,
              ];

        $CustomerModel->update($id, $data);
            $output = [
             'status' => true,
             'message' => 'Customer status changed Successfully!'
          ];
        }else{
            $output = [
                'status' => false,
                'message' => 'Error when trying to delete a customer'
             ];
        }
      return $this->response->setJSON($output);
    } 

    public function user_delete(){
         $data = $this->request->getPost();
        if(is_array($data)){
            $id = $data['id'];
        }
        if($id!='' && $id!=0){
            $CustomerModel = new CustomerModel();

            $response =$CustomerModel->user_delete($id);
            $output = [
             'status' => true,
             'message' => 'Customer User Deleted Successfully!'
          ];
        }else{
            $output = [
                'status' => false,
                'message' => 'Error when trying to delete a customer user'
             ];
        }
      return $this->response->setJSON($output);
    } 

     public function branch_delete(){
         $data = $this->request->getPost();
        if(is_array($data)){
            $id = $data['id'];
        }
        if($id!='' && $id!=0){
            $CustomerModel = new CustomerModel();

            $response =$CustomerModel->branch_delete($id);
            $output = [
             'status' => true,
             'message' => 'Customer Branch Deleted Successfully!'
          ];
        }else{
            $output = [
                'status' => false,
                'message' => 'Error when trying to delete a customer branch'
             ];
        }
      return $this->response->setJSON($output);
    } 

    public function branchUser_delete(){
         $data = $this->request->getPost();
        if(is_array($data)){
            $id = $data['id'];
        }
        if($id!='' && $id!=0){
            $CustomerModel = new CustomerModel();

            $response =$CustomerModel->user_delete($id);
            $output = [
             'status' => true,
             'message' => 'Customer Branch User Deleted Successfully!'
          ];
        }else{
            $output = [
                'status' => false,
                'message' => 'Error when trying to delete a customer branch user'
             ];
        }
      return $this->response->setJSON($output);
    } 



    public function branchUser_save() {
    $CustomerModel = new CustomerModel();
    $response =$CustomerModel->branchUser_save();
    echo json_encode($response);exit; 
    }

     public function branchUser_list(){
        $CustomerModel = new CustomerModel();
        $branch_id =$_POST['branch_id'];
        $user_list =$CustomerModel->branchUser_list($branch_id);
      if (!empty($user_list)) {
        $data = array(
       'user_list' => $user_list,
          
        );
      }
      else
      {
       $data['user_list'] ='';
      }
         

        $data_view=view('customer/branchU_list',$data);
        

        return $data_view;

       // echo json_encode($response);exit; 

     }


}
