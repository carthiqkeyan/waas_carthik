<?php 

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;



class CustomerModel extends Model
{ 

    protected $table      = 'customer_account';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','email','password','status'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $skipValidation     = false;



    public function account_save(){ 
    $customer_parent =$_SESSION['customer_id'];
    $id =($_POST['id']!='')?$_POST['id']:'';
  
    $query='';
    if($id==''){
        $email=$_POST['email'];
        $sql1 = $this->db->query("SELECT * FROM customer_account WHERE email = '$email' and status!=0 and is_active=1");
         $check = $sql1->getRow();

         if ($check!='') { 
             $response['status'] = 2;
             $response['message'] = "Email already exist";
             return  $response;
         }else{

             // $cus_number = "WAAS" . rand(10000, 99999);
          $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

             $cus_number = substr(str_shuffle($permitted_chars), 0, 6);

             $sql = "INSERT INTO customer_account (customer_parent,uniqueID,account_name,email,company,mobile,contact_name,location,password,status,is_active) VALUES ('$customer_parent','$cus_number',".$_POST['account_name']."','".$_POST['email']."','".$_POST['cus_company']."','".$_POST['cus_mobile']."','".$_POST['cus_contact_person']."','".$_POST['cus_location']."','".md5($_POST['password'])."',1,1)";

       $this->db->query($sql);
       $id =$this->db->insertID();
       $sql1 = "INSERT INTO system_users (customer_id,name,email,password,role_id,status,is_active) VALUES ('$id','".$_POST['account_name']."','".$_POST['email']."','".md5($_POST['password'])."','0',1,1)";

       $this->db->query($sql1);
      
       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Account',
                    "sub_function"=>'Add',
                      );

       $stmt=$this->insert_common_action($req_array);
         }
    }else{

       $sql = "UPDATE customer_account SET account_name='".$_POST['account_name']."',company='".$_POST['cus_company']."',mobile='".$_POST['cus_mobile']."',contact_name='".$_POST['cus_contact_person']."',location='".$_POST['cus_location']."' WHERE id=$id AND status=1";

       $this->db->query($sql);

       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'License',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);

    }
      
          if ($stmt) {
            $response['status'] = 1;
            $response['message'] = "Success";
            $response['id'] =$id;
            } 
            else{
             $response['status'] = 0;
             $response['message'] = "Failed !";
            }

            
        return $response;
     
    }

    public function user_save(){  


       if ($_POST['userId']!="") { 
        $id=$_POST['userId'];
       $sql = "UPDATE system_users SET name='".$_POST['user_name']."',role_id='".$_POST['role']."' WHERE id=$id";
     $this->db->query($sql);
     $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'User',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);
      }
     else
     {
    
      $email =$_POST['user_email'];
      $sql1 = $this->db->query("SELECT * FROM system_users WHERE email = '$email' and status=1 and is_active=1");
        $check = $sql1->getRow();

         if ($check!='') { 
             $response['status'] = 2;
             $response['message'] = "Email already exist";
             return  $response;
         }else{

    $sql = "INSERT INTO system_users (customer_id,name,email,password,role_id,status,is_active) VALUES ('".$_POST['id']."','".$_POST['user_name']."','".$_POST['user_email']."','".md5($_POST['user_password'])."','".$_POST['role']."',1,1)";

       $this->db->query($sql);
       $id =$this->db->insertID();
       $req_array=array("customer_id"=>$_POST['id'],
                    "module"=>'Customer',
                    "main_function"=>'User',
                    "sub_function"=>'Add',
                      );

       $stmt=$this->insert_common_action($req_array);
     }

      }

          if ($stmt) {
            $response['status'] = 1;
            $response['message'] = "Success";
            } 
            else{
             $response['status'] = 0;
             $response['message'] = "Failed !";
            }

        return $response;
     
    }

    public function license_save(){ 
  
     $id =$_POST['id'];
      if ($_POST['id']!="") {
     $sql = "UPDATE customer_license SET license='".$_POST['license']."',subscription='".$_POST['subscription_id']."' WHERE customer_id=$id AND status=1";

       $this->db->query($sql);

       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'License',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);
     }
     else{
       $sql = "INSERT INTO customer_license (customer_id,license,subscription,status) VALUES ('".$_POST['cusLic_id']."','".$_POST['license']."','".$_POST['subscription_id']."',1)";

       $this->db->query($sql);

       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'License',
                    "sub_function"=>'Add',
                      );

       $stmt=$this->insert_common_action($req_array);
     }

          if ($sql) {
            $response['status'] = 1;
            $response['message'] = "Success";
            } 
            else{
             $response['status'] = 0;
             $response['message'] = "Failed !";
            }

        return $response;
     
    }

    public function sms_email_save(){ 
     $id =$_POST['id'];
      // if ($_POST['id']!="") {
     $sql = "UPDATE customer_account SET sms_quota='".$_POST['cus_sms']."',email_quota='".$_POST['cus_email']."',sms_email_check='".$_POST['sms_email_check']."' WHERE id=$id AND status=1";

       $this->db->query($sql);

       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'SMS/Email',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);
     // }
     // else{
     //   $sql = "INSERT INTO customer_sms_email (customer_id,sms,email,status) VALUES ('".$_POST['cusSms_id']."','".$_POST['cus_sms']."','".$_POST['cus_email']."',1)";

     //   $this->db->query($sql);

     //   $req_array=array("customer_id"=>$id,
     //                "module"=>'Customer',
     //                "main_function"=>'SMS/Email',
     //                "sub_function"=>'Add',
     //                  );

     //   $stmt=$this->insert_common_action($req_array);
     // }

          if ($sql) {
            $response['status'] = 1;
            $response['message'] = "Success";
            } 
            else{
             $response['status'] = 0;
             $response['message'] = "Failed !";
            }

        return $response;
     
    }

    public function billing_save(){  
      $id =$_POST['id'];
      if ($_POST['id']!="") {
     $sql = "UPDATE customer_billing SET name='".$_POST['name']."',company='".$_POST['company']."',mobile='".$_POST['mobile']."',company_id='".$_POST['company_id']."',vat_number='".$_POST['vat_number']."',city='".$_POST['city']."',zip='".$_POST['zip']."',country='".$_POST['country']."',your_business='".$_POST['your_business']."',your_equipment='".$_POST['your_equipment']."' WHERE id=$id";
     $this->db->query($sql);
     $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Billing',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);
      }
     else
     {
      $sql = "INSERT INTO customer_billing (customer_id,name,company,mobile,company_id,vat_number,city,zip,country,your_business,your_equipment,status) VALUES (".$_POST['cusBill_id'].",'".$_POST['name']."','".$_POST['company']."','".$_POST['mobile']."','".$_POST['company_id']."','".$_POST['vat_number']."','".$_POST['city']."','".$_POST['zip']."','".$_POST['country']."','".$_POST['your_business']."','".$_POST['your_equipment']."',1)";

       $this->db->query($sql);
       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Billing',
                    "sub_function"=>'Add',
                      );

       $stmt=$this->insert_common_action($req_array);
           }

        if ($sql) {
          $response['status'] = 1;
          $response['message'] = "Success";
          } 
          else{
           $response['status'] = 0;
           $response['message'] = "Failed !";
          }

        return $response;
   
     
    }

     public function brand_save(){ 
  
     $response=array();
     $id =$_POST['id'];
     if ($_POST['id']!="") { 

     if (isset($_FILES["file"]) && $_FILES["file"]["name"]!='') {
        if ($_FILES["file"]["error"]== UPLOAD_ERR_OK) {
              $uploads_dir = './uploads';
              $tmp_name = $_FILES["file"]["tmp_name"];
              $name_ =  "img_".time()."_" . basename($_FILES["file"]["name"]);
              $ext=pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
              $file_name = $name_;    
              move_uploaded_file($tmp_name, "$uploads_dir/$name_");
              }

               $sql = "UPDATE customer_brand SET logo='$file_name' WHERE id=$id";
                 $this->db->query($sql);
            }else{
               $sql=1;
            } 
       $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Brand Logo',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);


     }
     else
     {
        if (isset($_FILES["file"]) && $_FILES["file"]["name"]!='') {
          if ($_FILES["file"]["error"]== UPLOAD_ERR_OK) {
              $uploads_dir = './uploads';
              $tmp_name = $_FILES["file"]["tmp_name"];
              $name_ =  "img_".time()."_" . basename($_FILES["file"]["name"]);
              $ext=pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
              $file_name = $name_;    
              move_uploaded_file($tmp_name, "$uploads_dir/$name_");
              }

            } 

      $sql = "INSERT INTO customer_brand (customer_id,logo,status) VALUES (".$_POST['cusLogo_id'].",'".$file_name."',1)";


       $this->db->query($sql);
        $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Brand Logo',
                    "sub_function"=>'Add',
                      );

       $stmt=$this->insert_common_action($req_array);
     }

      if ($sql) {
        $response['status'] = 1;
        $response['message'] = "Success";
        } 
        else{
         $response['status'] = 0;
         $response['message'] = "Failed !";
        }

    return $response;
     
    }

    function billing_details($id){

    $qry = $this->db->query("SELECT customer_billing.* FROM customer_account join customer_billing on customer_billing.customer_id = customer_account.id WHERE  customer_account.uniqueID = '$id' AND customer_account.status=1");
    $response = $qry->getRow();

        return $response;
    }

     function license_details($id){

    $qry = $this->db->query("SELECT * FROM customer_license WHERE  customer_id = '$id' AND status=1");
    $response = $qry->getRow();

        return $response;
    }


     function sms_details($id){

    $qry = $this->db->query("SELECT * FROM customer_sms_email WHERE  customer_id = '$id' AND status=1");
    $response = $qry->getRow();

        return $response;
    }

    // function customer_License(){
    // $customer_id =$_SESSION['customer_id'];
    // $qry = $this->db->query("SELECT license FROM customer_license WHERE  customer_id = '$customer_id' AND status=1");
    // $response = $qry->getRow();

    //     return $response;
    //   }

    function customer_License($id){
      // $customer_id =$_SESSION['customer_id'];
      $qry = $this->db->query("SELECT license FROM customer_license WHERE  customer_id = '$id' AND status=1");
      $response = $qry->getRow();
      return $response;

    }

    function brand_details($id){

    $qry = $this->db->query("SELECT * FROM customer_brand WHERE  customer_id = '$id' AND status=1");
    $response = $qry->getRow();

        return $response;
    }

    function single_branch(){

    $id = $_POST['branch_id'];
    $qry = $this->db->query("SELECT * FROM customer_branch WHERE  id = '$id' AND status=1");
    $response = $qry->getRow();

        return $response;
    }

     function single_user(){

    $id = $_POST['user_id'];
    $qry = $this->db->query("SELECT * FROM system_users WHERE  id = '$id' AND status=1");
    $response = $qry->getRow();

        return $response;
    }

    // function single_branchuser(){

    // $id = $_POST['user_id'];
    // $qry = $this->db->query("SELECT * FROM system_users WHERE  id = '$id' AND status=1");
    // $response = $qry->getRow();

    //     return $response;
    // }

    // function customer_details($id){

    // $qry = $this->db->query("SELECT * FROM customer_account WHERE  id = '$id' AND status!=0 AND is_active=1");
    // $response = $qry->getRow();

    //     return $response;
    // }


    function customer_details($id){

    $qry = $this->db->query("SELECT * FROM customer_account WHERE  uniqueID = '$id' AND status!=0 AND is_active=1");
    $response = $qry->getRow();

        return $response;
    }


    function customer_users($id){
  
    $qry = $this->db->query("SELECT system_users.*,system_roles.name as role  FROM system_users left outer join system_roles on system_roles.id = system_users.role_id WHERE  system_users.customer_id = '$id' AND system_users.status=1 AND system_users.is_active=1 AND system_users.branch_id=0 AND system_users.role_id!=0 AND system_users.customer_id!=0 ");
    $response = $qry->getResultArray();

        return $response;
    }

     function get_role($role_type='',$customer_id){
  
        $customer_id =$_SESSION['customer_id'];

        if ($customer_id!=0) {
            $str_query = "SELECT *  FROM system_roles WHERE customer_id='$customer_id' AND status=1";
            if($role_type!=''){
                $str_query.= " AND is_customer_role = ".$role_type;
            }
            // $qry = $this->db->query("SELECT *  FROM system_roles WHERE customer_id='$customer_id' AND status=1");
            if($role_type!=''){
              $str_query.= " AND is_customer_role = ".$role_type;
          }
      
          // if($role_type!=''){
          //     $str_query.= " AND is_customer_role = ".$role_type;
          // }
        }
        else
        {
            $str_query ="SELECT * FROM system_roles WHERE customer_id=0 AND status=1 ";
        }
        
        // echo $str_query."<br>";
        $qry = $this->db->query($str_query);
        $response = $qry->getResultArray();
    
            return $response;
    }

    function change_password()
    {
        $id =$_POST['id'];
        $password=md5($_POST['change_password']);
        $sql = "UPDATE customer_account SET password='$password' WHERE id=$id";

       $this->db->query($sql);
        if ($sql) {
        $response['status'] = 1;
        $response['message'] = "Success";
        } 
        else{
         $response['status'] = 0;
         $response['message'] = "Failed !";
        }

    return $response;
    }

    function user_delete($id)
    {
        $response=array();
        $status=0;
        $sql = "UPDATE system_users SET status='".$status."' WHERE id=$id";
        $response= $this->db->query($sql);
         return $response;
    }

    function branch_details($id){

    $qry = $this->db->query("SELECT * FROM customer_branch WHERE  customer_id = '$id' AND status=1 AND is_active=1");
    $response = $qry->getResultArray();

        return $response;
    }

    function branch_save(){  
    if ($_POST['branchId']!="") { 
        $id=$_POST['branchId'];
       $sql = "UPDATE customer_branch SET location_name='".$_POST['location_name']."',contact_person='".$_POST['contact_person']."',contact_email='".$_POST['contact_email']."',contact_mobile='".$_POST['contact_mobile']."',license='".$_POST['branch_license']."' WHERE id=$id";
     $this->db->query($sql);
     $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'Branch',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);
      }
     else
     {

    $sql = "INSERT INTO customer_branch (customer_id,location_name,license,contact_person,contact_email,contact_mobile,status,is_active) VALUES ('".$_POST['id']."','".$_POST['location_name']."','".$_POST['branch_license']."','".$_POST['contact_person']."','".$_POST['contact_email']."','".$_POST['contact_mobile']."',1,1)";

       $this->db->query($sql);
       $id =$this->db->insertID();

       $req_array=array("customer_id"=>$_POST['id'],
                    "module"=>'Customer',
                    "main_function"=>'Branch',
                    "sub_function"=>'Add',
                      );

       $stmt=$this->insert_common_action($req_array);

     }

          if ($sql) {
            $response['status'] = 1;
            $response['message'] = "Success";
            } 
            else{
             $response['status'] = 0;
             $response['message'] = "Failed !";
            }

        return $response;
     
    }

    function branchUser_save(){  

      if ($_POST['Branch_userId']!="") { 
        $id=$_POST['Branch_userId'];
       $sql = "UPDATE system_users SET name='".$_POST['brandUser_name']."',role_id='".$_POST['branch_role']."' WHERE id=$id";
     $this->db->query($sql);
     $req_array=array("customer_id"=>$id,
                    "module"=>'Customer',
                    "main_function"=>'User',
                    "sub_function"=>'Edit',
                      );

       $stmt=$this->insert_common_action($req_array);
      }
     else
     {

     $email =$_POST['brandUser_email'];
      $sql1 = $this->db->query("SELECT * FROM system_users WHERE email = '$email' and status=1 and is_active=1");
        $check = $sql1->getRow();

         if ($check!='') { 
             $response['status'] = 2;
             $response['message'] = "Email already exist";
             return  $response;
         }else{

     $sql = "INSERT INTO system_users (customer_id,name,email,password,role_id,branch_id,status,is_active) VALUES ('".$_POST['id']."','".$_POST['brandUser_name']."','".$_POST['brandUser_email']."','".md5($_POST['brandUser_password'])."','".$_POST['branch_role']."','".$_POST['branch_id']."',1,1)";

       $this->db->query($sql);
       $id =$this->db->insertID();
       $req_array=array("customer_id"=>$_POST['id'],
                    "module"=>'Customer',
                    "main_function"=>'Branch User',
                    "sub_function"=>'Add',
                      );

       $stmt=$this->insert_common_action($req_array);
     }
   }

          if ($sql) {
            $response['status'] = 1;
            $response['message'] = "Success";
            } 
            else{
             $response['status'] = 0;
             $response['message'] = "Failed !";
            }

        return $response;
     
    }

    function branchUser_list($branch_id){
    $response=array();
    $qry = $this->db->query("SELECT * FROM system_users WHERE  branch_id = '$branch_id' AND status=1 AND is_active=1");
    $sql = $qry->getResultArray();

     if ($sql) {

            $response =$sql;
            } 
            else{
             $response = '';

            }

        return $response;
    }

    function branch_delete($id)
    {
        $response=array();
        $status=0;
        $sql = "UPDATE customer_branch SET status='".$status."' WHERE id=$id";
        $response= $this->db->query($sql);
         return $response;
    }

    function active_sub($customer_id){
    $response=array();
    $qry = $this->db->query("SELECT id FROM subscription WHERE  customers = '$customer_id' AND status=1");
    $sql = $qry->getRow();

        return $sql;
    }

     function branch_count($customer_id){
    $qry = $this->db->query("SELECT sum(license) as license FROM customer_branch WHERE  customer_id = '$customer_id' AND status=1");
    $response = $qry->getRow();

        return $response;
    }

    function insert_common_action($req_array){
    $status = 1;
    $is_active = 1;
    $cby =1; 
    $mby = 1; 
    $cdate = date('Y-m-d H:i:s');
    $mdate = date('Y-m-d H:i:s');

    $sql = "INSERT INTO common_history (customer_id,module,main_function,sub_function,status,is_active,cby,cdate,mby,mdate) VALUES ('".$req_array['customer_id']."','".$req_array['module']."','".$req_array['main_function']."','".$req_array['sub_function']."','".$status."','".$is_active."','".$cby."','".$cdate."','".$mby."','".$mdate."')";

       $this->db->query($sql);
  
    
    return $sql;
  }

    

}
