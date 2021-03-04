<?php 

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;



class ReportModel extends Model
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

    public function license_count(){  
        $customer_id =$_SESSION['customer_id'];
        $builder = $this->db->table('customer_brand');
        $builder->where('customer_id',$customer_id);
        $query = $builder->get();
        $branch_count = $query->getResultArray();
        $response=count($branch_count);
        return $response;
     
    }

    public function customer_users_count(){  
        $customer_id =$_SESSION['customer_id'];
        $builder = $this->db->table('system_users');
        $builder->where('customer_id',$customer_id);
        $query = $builder->get();
        $branch_count = $query->getResultArray();
        $response=count($branch_count);
        return $response;
     
    }

    public function branch_count(){ 
        $customer_id =$_SESSION['customer_id'];
        $builder = $this->db->table('customer_branch');
        $builder->where('customer_id',$customer_id);
        $query = $builder->get();
        $branch_count = $query->getResultArray();
        $response=count($branch_count);
        return $response;
     
    }

    function branch_list($customer_Id='',$branch_id=''){
    $response=array();

   if ($customer_Id!="") {
       $check=" and customer_id ='$customer_Id' ";
   }
   else
   {
    $check ="";
   }

    $qry = $this->db->query("SELECT id,location_name FROM customer_branch WHERE  status=1 AND is_active=1 $check");
    $sql = $qry->getResultArray();


     if ($sql) {

            $response =$sql;
            } 
            else{
             $response=array();
            }

        return $response;
    }

    function account_list(){
    $response=array();
    $customer_id =$_SESSION['customer_id'];

    if ($customer_id!=0) {
       $check=" and customer_parent ='$customer_id' ";
    }
    else
    {
        $check = "";
    }
    
    $qry = $this->db->query("SELECT * FROM customer_account WHERE  status!=0 AND is_active=1 $check");
    $sql = $qry->getResultArray();



     if ($sql) {

            $response =$sql;
            } 
            else{
                $response=array();
            }

        return $response;
    }

    function customer_list(){
    $customer_id =$_SESSION['customer_id'];
    $r =array();
    //  if($customer_id!=0){
    $qry = $this->db->query("SELECT id,account_name FROM customer_account WHERE  customer_parent = '$customer_id' AND status!=0 AND is_active=1");
    // }
    // else
    // {
    // $qry = $this->db->query("SELECT id,account_name FROM customer_account WHERE status!=0 AND is_active=1");
    // }

    $cus_list = $qry->getResultArray();
   
    foreach ($cus_list as $value) {
        $cus_id=$value['id'];
        $response['customer_name'] =$value['account_name'];
        $response['customer_id'] =$value['id'];
        $check=" and customer_id ='$cus_id' ";
        
        $qry1 = $this->db->query("SELECT count(*) as count_rows FROM customer_branch WHERE  status=1 AND is_active=1 $check ");
        $response1 = $qry1->getRow();        
        $qry4 = $this->db->query("SELECT count(*) as count_rows  FROM customer_branch WHERE   status=1 AND is_active=1 AND YEAR(cdate) = YEAR(CURRENT_DATE) AND MONTH(cdate) = MONTH(CURRENT_DATE)  $check ");
        $response4 = $qry4->getRow();
        $response['branch_count'] =$response1->count_rows;
        $response['branch_month'] =$response4->count_rows;
        $qry2 = $this->db->query("SELECT id,COALESCE(sum(license),0) as license FROM customer_license WHERE status=1 $check");
        $response2 = $qry2->getRow();
        $qry2 = $this->db->query("SELECT id,COALESCE(sum(license),0) as license FROM customer_license WHERE status=1  AND YEAR(cdate) = YEAR(CURRENT_DATE) AND MONTH(cdate) = MONTH(CURRENT_DATE) $check");
        $response5 = $qry2->getRow();  
        $response['brand_count'] =$response2->license;
        $response['brand_month'] =$response5->license;
        $qry3 = $this->db->query("SELECT count(*) as count_rows FROM system_users WHERE  status=1 AND is_active=1 $check ");
        $response3 = $qry3->getRow();
        $response['user_count'] =$response3->count_rows;
        $r[] = $response;
      }
        return $r;
    }
  
    function customer_details($customer_id){
    $qry = $this->db->query("SELECT id,account_name FROM customer_account WHERE  id = '$customer_id' AND status!=0 AND is_active=1");
    $cus_details = $qry->getRow();
 
        $cus_id=$cus_details->id;
        $response['customer_name'] =$cus_details->account_name;
        $response['customer_id'] =$cus_details->id;
        $check=" and customer_id ='$cus_id' ";
        
        $qry1 = $this->db->query("SELECT count(*) as count_rows FROM customer_branch WHERE  status=1 AND is_active=1 $check ");
        $response1 = $qry1->getRow();        
        $qry4 = $this->db->query("SELECT count(*) as count_rows  FROM customer_branch WHERE   status=1 AND is_active=1 AND YEAR(cdate) = YEAR(CURRENT_DATE) AND MONTH(cdate) = MONTH(CURRENT_DATE)  $check ");
        $response4 = $qry4->getRow();
        $response['branch_count'] =$response1->count_rows;
        $response['branch_month'] =$response4->count_rows;
        $qry2 = $this->db->query("SELECT license FROM customer_license WHERE status=1 $check");
        $response2 = $qry2->getRow();
        $qry2 = $this->db->query("SELECT license FROM customer_license WHERE status=1  AND YEAR(cdate) = YEAR(CURRENT_DATE) AND MONTH(cdate) = MONTH(CURRENT_DATE) $check");
        $response5 = $qry2->getRow();

        $response['brand_count'] =(!empty($response2))?$response2->license:0;
        $response['brand_month'] =(!empty($response2))?$response5->license:0;

        
        $qry3 = $this->db->query("SELECT count(*) as count_rows FROM system_users WHERE  status=1 AND is_active=1 $check ");
        $response3 = $qry3->getRow();
        $response['user_count'] =$response3->count_rows;
        $qry4 = $this->db->query("SELECT id,location_name FROM customer_branch WHERE  status=1 AND is_active=1 $check");
        $sql4 = $qry4->getResultArray();
        $response['branch_list'] =$sql4;
        $r[] = $response;

        return $r;
    }

     function branch_details($branch_id){


        $check=" and id ='$branch_id' ";
        

        $qry2 = $this->db->query("SELECT id,COALESCE(sum(license),0) as license FROM customer_branch WHERE status=1 $check");
        $response2 = $qry2->getRow();
        $qry2 = $this->db->query("SELECT id,COALESCE(sum(license),0) as license FROM customer_branch WHERE status=1  AND YEAR(cdate) = YEAR(CURRENT_DATE) AND MONTH(cdate) = MONTH(CURRENT_DATE) $check");
        $response5 = $qry2->getRow();
        $response['brand_count'] =$response2->license;
        $response['brand_month'] =$response5->license;

        $qry3 = $this->db->query("SELECT count(*) as count_rows FROM system_users WHERE  status=1 AND is_active=1 $check ");
        $response3 = $qry3->getRow();
        $response['user_count'] =$response3->count_rows;
        $qry4 = $this->db->query("SELECT id,location_name FROM customer_branch WHERE  status=1 AND is_active=1 $check");
        $sql4 = $qry4->getResultArray();
        $response['branch_list'] =$sql4;
        $r[] = $response;

        return $r;
    }


    function report_csv_details($customer_id){

     $qry = $this->db->query("SELECT id,account_name,uniqueID FROM customer_account WHERE  customer_parent = '$customer_id' AND status!=0 AND is_active=1");
   
      if ($customer_id!=0) {
         $qry1 = $this->db->query("SELECT id,account_name,uniqueID FROM customer_account WHERE  id = '$customer_id' AND status!=0 AND is_active=1");
      $response3= $qry1->getRow();
      $uniqueID =$response3->uniqueID;
      }
      else
      {
    $uniqueID ='sa12we';
      }
      
    // }
    // else
    // {
    // $qry = $this->db->query("SELECT id,account_name FROM customer_account WHERE status!=0 AND is_active=1");
    // }

    $cus_list = $qry->getResultArray();
   
    foreach ($cus_list as $value) {
        $cus_id=$value['id'];
        $response['customer_name'] =$value['account_name'];
        $response['customer_id'] =$value['id'];
        $check=" and customer_id ='$cus_id' ";
        
        $qry1 = $this->db->query("SELECT count(*) as count_rows FROM customer_branch WHERE  status=1 AND is_active=1 $check ");
        $response1 = $qry1->getRow();        
        $qry4 = $this->db->query("SELECT count(*) as count_rows  FROM customer_branch WHERE   status=1 AND is_active=1 AND YEAR(cdate) = YEAR(CURRENT_DATE) AND MONTH(cdate) = MONTH(CURRENT_DATE)  $check ");
        $response4 = $qry4->getRow();
        $response['branch_count'] =$response1->count_rows;
        $response['branch_month'] =$response4->count_rows;
        $qry2 = $this->db->query("SELECT id,COALESCE(sum(license),0) as license FROM customer_license WHERE status=1 $check");
        $response2 = $qry2->getRow();
        $qry5 = $this->db->query("SELECT id,COALESCE(sum(license),0) as license FROM customer_branch WHERE status=1  $check");
        $response5 = $qry5->getRow(); 
        $balance_license = $response2->license-$response5->license;
        $response['brand_count'] =$response2->license;
        $response['brand_balance'] =$balance_license;
        $qry6 = $this->db->query("SELECT id,COALESCE(sum(sms),0) as sms FROM customer_sms_email WHERE status=1 $check");
        $response6 = $qry6->getRow();
        $qry7 = $this->db->query("SELECT id,COALESCE(sum(email),0) as email FROM customer_sms_email WHERE status=1 $check");
        $response7 = $qry7->getRow();  
        $response['sms_count'] =$response6->sms;
        $response['email_month'] =$response7->email;
        $qry3 = $this->db->query("SELECT count(*) as count_rows FROM system_users WHERE  status=1 AND is_active=1 $check ");
        $response3 = $qry3->getRow();
        $response['user_count'] =$response3->count_rows;
        $r[] = $response;
      }
        $res['arr_list']=$r;
        $res['unique_id']=$uniqueID;
        return $res;
    }

}
