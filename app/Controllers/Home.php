<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		//return view('welcome_message');
		return view('home/login');
	}
	
	// public function index2()
	// {
	// 	//return view('welcome_message');
	// 	return view('dashboard/index2');
	// }
}