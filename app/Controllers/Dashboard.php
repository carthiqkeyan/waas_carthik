<?php namespace App\Controllers;

use App\Models\CustomerModel;
class Dashboard extends BaseController
{
	public function index()
	{
		if(isset($this->session->is_logged_in) && $this->session->is_logged_in === true){
			$data['page_title'] = " Admin : Dashboard ";
			$counts = $this->get_dashboard_counts(); 			
			$data['customers'] = $counts['customer_count'];
			$data['users'] = 10;
			$data['hotspots'] = $counts['hotspot_count'];
			$data['branches'] = $counts['branches_count'];
			$data['sms'] = $counts['sms_count'];
			$data['email'] = $counts['email_count'];
			//return view('welcome_message');

			return view('dashboard/index',$data);
		}else{
			$data['page_title'] = " Admin : Login ";

			return view('login',$data);
		}
	}


	public function get_dashboard_counts(){
		$customer_parent =$_SESSION['customer_id'];
		// get customer count 
		$CustomerModel = new CustomerModel();
		if($customer_parent!="" && $customer_parent!=0){
			$data['customer_count'] = $CustomerModel->where('customer_parent',$customer_parent)->where('status',1)->where('status',2)->where('is_active',1)->countAllResults();
			$data['branches_count'] = $CustomerModel->select('customer_branch.*')->join('customer_branch','customer_branch.customer_id=customer_account.id')->where('customer_branch.is_active',1)->where('customer_account.status!=',0)->where('customer_account.is_active',1)->where('customer_account.customer_parent',$customer_parent)->countAllResults();
			$hotspots = $CustomerModel->select('sum(customer_license.license) as license_count')->join('customer_license','customer_license.customer_id=customer_account.id')->where('customer_account.status!=',0)->where('customer_account.is_active',1)->where('customer_account.customer_parent',$customer_parent)->findAll();
			$data['sms_count'] = $CustomerModel->select('COALESCE(sum(customer_sms_email.sms),0) as sms_count')->join('customer_sms_email','customer_sms_email.customer_id=customer_account.id')->where('customer_account.status=',1)->where('customer_account.is_active',1)->where('customer_account.customer_parent',$customer_parent)->findAll();
			$data['email_count'] = $CustomerModel->select('COALESCE(sum(customer_sms_email.email),0) as email_count')->join('customer_sms_email','customer_sms_email.customer_id=customer_account.id')->where('customer_account.status=',1)->where('customer_account.is_active',1)->where('customer_account.customer_parent',$customer_parent)->findAll();
		}else{
			$data['customer_count'] = $CustomerModel->where('status',1)->where('is_active',1)->countAllResults();
			$data['branches_count'] = $CustomerModel->select('customer_branch.*')->join('customer_branch','customer_branch.customer_id=customer_account.id')->where('customer_branch.is_active',1)->where('customer_account.status!=',0)->where('customer_account.is_active',1)->countAllResults();
			$hotspots = $CustomerModel->select('sum(customer_license.license) as license_count')->join('customer_license','customer_license.customer_id=customer_account.id')->where('customer_account.status!=',0)->where('customer_account.is_active',1)->findAll();
			$data['sms_count'] = $CustomerModel->select('COALESCE(sum(customer_sms_email.sms),0) as sms_count')->join('customer_sms_email','customer_sms_email.customer_id=customer_account.id')->where('customer_sms_email.status=',1)->where('customer_account.is_active',1)->findAll();
			$data['email_count'] = $CustomerModel->select('COALESCE(sum(customer_sms_email.email),0) as email_count')->join('customer_sms_email','customer_sms_email.customer_id=customer_account.id')->where('customer_sms_email.status=',1)->where('customer_account.is_active',1)->findAll();
		}
		if(is_array($hotspots) && count($hotspots)!=0){
			$data['hotspot_count'] = $hotspots[0]['license_count'];
		}
		if(is_array($data['sms_count']) && count($data['sms_count'])!=0){
			$data['sms_count'] = $data['sms_count'][0]['sms_count'];
		}
		if(is_array($data['email_count']) && count($data['email_count'])!=0){
			$data['email_count'] = $data['email_count'][0]['email_count'];
		}

		return $data;
	}
	
	// public function index2()
	// {
	// 	//return view('welcome_message');
	// 	return view('dashboard/index2');
	// }
}
