<?php

namespace App\Controllers;

class HomeController extends AppController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function settings()
	{
		$SettingsModel = new \App\Models\SettingsModel();
		//print_r($CategoryModel->get_category());
		$setuplist = $SettingsModel->get_settings2();
		helper('url');
		$uri = service('uri');
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			
			$n = count($dat);
			if($n) {
				for($a=0;$a<$n;$a++) {
					$oname = $dat["option_name"][$a];
					$ovalue = $dat["option_value"][$a];
					$SettingsModel->edit_settings($oname,$ovalue);
				}
				session()->setFlashdata('success', "Settings berhasil diupdate");
				redirect()->to($uri->getSegment(1));
			}
		}
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"setuplist" => $setuplist

		];	
		
		return view('settings',$data);
	}

	public function home()
	{
		$data = [
			"page"	=> "home",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			//
		];	
		
		return view('home',$data);
	}

	//--------------------------------------------------------------------

}
