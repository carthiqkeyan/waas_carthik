<?php 
namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ReportModel;

class Report extends BaseController
{
	public function index()
	{
       if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 

       	if (isset($_SESSION['role_name']) || isset($_SESSION['reports'])) {
       		
	   $ReportModel = new ReportModel();
       $CustomerModel = new CustomerModel();
       $data['customer_id'] =$_SESSION['customer_id']; 
       $data['license_details'] =$ReportModel->license_count();
       $data['customer_users'] =$ReportModel->customer_users_count();
       $data['branch_details'] =$ReportModel->branch_list();
       $data['account_list'] =$ReportModel->account_list();
       $data['arr_customer'] = $ReportModel->customer_list();
	   $data['page_title'] = "Admin : Report";
	   // print_r($data['branch_details']);exit();
		return view('report/report',$data);

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

	public function view_details($customer_id,$branch_id='')
	{
		 if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true)
       { 

	   $ReportModel = new ReportModel();
       $CustomerModel = new CustomerModel(); 
       $data['license_details'] =$ReportModel->license_count($customer_id);
       $data['customer_users'] =$ReportModel->customer_users_count($customer_id);
       $data['branch_details'] =$ReportModel->branch_list($customer_id,$branch_id);
       $data['arr_customer'] = $ReportModel->customer_details($customer_id);
       $data['customer_id'] =$customer_id;
       $data['branch_id']=$branch_id;

	   $data['page_title'] = "Admin : Report";
		return view('report/view_details',$data);

		}else 
    {
    $data['page_title'] = " Admin : Login ";
      return view('login',$data);     
    }

	}

	public function get_customer()
	{	 $data=array();
		$customer_id =$_POST['customer_id'];
		$ReportModel = new ReportModel();
		$data['arr_customer'] = $ReportModel->customer_details($customer_id);
		$data['data_view']=view('report/customer_details',$data);

		echo  json_encode($data);exit;
	}

	public function get_branch()
	{	
		$data=array();
		$branch_id =$_POST['branch_id'];
		$ReportModel = new ReportModel();
		$data['arr_customer'] = $ReportModel->branch_details($branch_id);
		$data['branch_id'] =$branch_id;
		$data['customer_id']=$_POST['customer_id'];
		echo json_encode($data);exit;
	}

	public function download_csv($customer_id)
	 {
      
		$ReportModel = new ReportModel();
	     $arr= $ReportModel->report_csv_details($customer_id);
	     $data['arr_customer']=$arr['arr_list'];
	    $view=view('report/report_excel',$data);
        $file=$arr['unique_id'].".xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
        echo $view;exit;
	 }

}
