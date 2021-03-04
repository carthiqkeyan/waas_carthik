<?php
namespace App\Controllers;

use App\Models\SubscriptionModel;
use App\Models\CustomerModel;

class Subscription extends BaseController{

    protected $db = "";

    public function __construct(){
   
    }

	public function index(){
		return view('customer/list');
    }
  
    public function list(){
     if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 
  
   if (isset($_SESSION['role_name']) || isset($_SESSION['subscription-management'])) { 

        $SubscriptionModel = new SubscriptionModel();
         $customer_parent =$_SESSION['customer_id'];
         if ($customer_parent==0) {
       $data['arr_subscription'] = $SubscriptionModel->select('subscription.*,customer_account.email')->join('customer_account', 'customer_account.id = subscription.customers','left')->where('subscription.status!=',0)->orderBy('subscription.id', 'DESC')->findAll();
       }else
         {
            $data['arr_subscription'] = $SubscriptionModel->select('subscription.*,customer_account.email')->join('customer_account', 'customer_account.id = subscription.customers','left')->where('subscription.customers',$customer_parent)->where('subscription.status!=',0)->orderBy('subscription.id', 'DESC')->findAll();
         }

        $data['table_title'] = " Subscription List";
        $data['page_title'] = " Subscription : List";
        $data['action_access'] = isset($this->action_access['subscription-management'])?$this->action_access['subscription-management']:$this->action_access;
       return view('subscription/list',$data);

       }
         else
         {
           return view('templates/error');
         }

       }else 
    {
    $data['page_title'] = " Admin : Login ";
      return view('login',$data);     
    }

     }

     public function view(){
       if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 
      if (isset($_SESSION['role_name']) || isset($_SESSION['subscription-management'])) { 
        $id =  $this->request->uri->getSegment(3);
        $SubscriptionModel = new SubscriptionModel();
        $data['arr_subDetails'] = $SubscriptionModel->join('customer_account', 'customer_account.id = subscription.customers')->where('subscription.id', $id)->first();
        $data['table_title'] = " Subscription List";
        $data['page_title'] = " Subscription : List";
        $data['action_access'] = isset($this->action_access['subscription-management'])?$this->action_access['subscription-management']:$this->action_access;
         return view('subscription/view',$data);
         }
         else
         {
           return view('templates/error');
         }
         
          }else 
          {
          $data['page_title'] = " Admin : Login ";
            return view('login',$data);     
          }
     }

      public function addedit(){

         if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 
      if (isset($_SESSION['role_name']) || isset($_SESSION['subscription-management'])) { 

           $id =  $this->request->uri->getSegment(3);
            $CustomerModel = new CustomerModel();
            $SubscriptionModel = new SubscriptionModel();
            $customer_parent =$_SESSION['customer_id'];
           if($id!=0  && $id!=""){
            $action = 'Edit';
            $data['id'] =$id;
           
         if ($customer_parent==0) {
            $data['customer'] =  $CustomerModel->where('status','1')->orderBy('id', 'DESC')->findAll();
            }else
         {
             $data['customer'] =  $CustomerModel->where('customer_account.customer_parent',$customer_parent)->where('status','1')->orderBy('id', 'DESC')->findAll();
         }
            $data['arr_subDetails'] = $SubscriptionModel->where('id', $id)->first();

        }else if($id==0){
            $action = 'Add';
            $data['id'] ='';
           if ($customer_parent==0) {
            $data['customer'] =  $CustomerModel->where('status','1')->orderBy('id', 'DESC')->findAll();
            }else
         {
             $data['customer'] =  $CustomerModel->where('customer_account.customer_parent',$customer_parent)->where('status','1')->orderBy('id', 'DESC')->findAll();
         }

        }

        $data['table_title'] = " Subscription List";
        $data['page_title'] = " Subscription : List";
             
         return view('subscription/add',$data);  

         }
         else
         {
           return view('templates/error');
         }
         
          }else 
          {
          $data['page_title'] = " Admin : Login ";
            return view('login',$data);     
          }

    }

      public function delete_sub(){
        $CustomerModel = new CustomerModel();
         $data = $this->request->getPost();
        if(is_array($data)){
            $id = $data['id'];
        }
        if($id!='' && $id!=0){
             $SubscriptionModel = new SubscriptionModel();
             $data = [
            'status' => '0',
              ];

        $SubscriptionModel->update($id, $data);
            $output = [
             'status' => true,
             'message' => 'Subscription Deleted Successfully!'
          ];
        }else{
            $output = [
                'status' => false,
                'message' => 'Error when trying to delete a subscription'
             ];
        }
    
       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Subscription',
                    "sub_function"=>'Delete',
                      );

      $stmt=$CustomerModel->insert_common_action($req_array);

      return $this->response->setJSON($output);
    } 

      // insert data
    public function store() {
      $SubscriptionModel = new SubscriptionModel();
      $CustomerModel = new CustomerModel();
      $id = $this->request->getVar('id');
      $data = [
          'package_month' => $this->request->getVar('package_month'),
          'description'   => $this->request->getVar('description'),
          'start_date'    => $this->request->getVar('start_date'),
          'end_date'    => $this->request->getVar('end_date'),
          'customers'     => $this->request->getVar('customers'),
          'status'        => $this->request->getVar('status'),
      ];

      if ($id=="") {
         $result=  $SubscriptionModel->insert($data);

          $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Subscription',
                    "sub_function"=>'Add',
                      );

      $stmt=$CustomerModel->insert_common_action($req_array);
      }
      else
      {
         $result = $SubscriptionModel->update($id,$data);

          $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Subscription',
                    "sub_function"=>'Edit',
                      );

      $stmt=$CustomerModel->insert_common_action($req_array);
      }
    

      if ($result) {
        $response['status']=1;
        $response['message']='Success';
      }
      else{
        $response['status']=0;
        $response['message']='Faield';
      }

     echo json_encode($response);exit; 
    }
}
?>