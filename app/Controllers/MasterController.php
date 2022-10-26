<?php

namespace App\Controllers;

class MasterController extends AppController
{
	public function index()
	{
		//return view('welcome_message');
	}

	public function edit_faskes($id)
	{
		helper('url');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$faskes = $MasterModel->get_faskes_detail($id);
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'faskes_type' => 'required',
				'faskes_name' => 'required',
				'faskes_address' => 'required',
				'faskes_phone' => 'required',
				'province_id' => 'required',
				'city_id' => 'required'
			], [
				"faskes_type" => [
					"required" => "Silakan isi Tipe Faskes"
				],
				"faskes_name" => [
					"required" => "Silakan isi Nama Faskes"
				],
				"faskes_address" => [
					"required" => "Silakan isi Alamat Faskes"
				],
				"faskes_phone" => [
					"required" => "Silakan isi No Telepon Faskes"
				],
				"province_id" => [
					"required" => "Silakan isi Provinsi"
				],
				"city_id" => [
					"required" => "Silakan isi kota"
				],
			]);

			if (!$validation->withRequest($this->request)->run()) {
				//print_r($validation->getErrors());
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				$dat["id"]=$id;
				$MasterModel->edit_faskes($dat);
				session()->setFlashdata('success', "Faskes berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$prolist = $MasterModel->get_province_select();
		$citylist = $MasterModel->get_city_select();
		$data = [
			"page" => "edit_faskes",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"id" => $id,
			"citylist" => $citylist,
			"prolist" => $prolist,
			"faskes" => $faskes

		];
		return view('master/edit_faskes',$data);
	}

	public function add_faskes()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'faskes_type' => 'required',
				'faskes_name' => 'required',
				'faskes_address' => 'required',
				'faskes_phone' => 'required',
				'province_id' => 'required',
				'city_id' => 'required'
			], [
				"faskes_type" => [
					"required" => "Silakan isi Tipe Faskes"
				],
				"faskes_name" => [
					"required" => "Silakan isi Nama Faskes"
				],
				"faskes_address" => [
					"required" => "Silakan isi Alamat Faskes"
				],
				"faskes_phone" => [
					"required" => "Silakan isi No Telepon Faskes"
				],
				"province_id" => [
					"required" => "Silakan isi Provinsi"
				],
				"city_id" => [
					"required" => "Silakan isi kota"
				],
			]);

			if (!$validation->withRequest($this->request)->run()) {
				//print_r($validation->getErrors());
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				
				$MasterModel->add_faskes($dat);
				session()->setFlashdata('success', "Faskes berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		

		$prolist = $MasterModel->get_province_select();
		$citylist = $MasterModel->get_city_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_faskes",
			"citylist" => $citylist,
			"prolist" => $prolist
			
		];
		return view('master/add_faskes',$data);
	}

	public function get_faskes()
	{
		$MasterModel = new \App\Models\MasterModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$faskes_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($faskes_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$MasterModel->delete_faskes($faskes_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Faskes berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		$faskeslist = $MasterModel->get_faskes();
		$data = [
			"page" => "get_faskes",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"faskeslist" => $faskeslist

		];
		return view('master/get_faskes',$data);
	}


	public function edit_city($id)
	{
		helper('url');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$city = $MasterModel->get_city_detail($id);
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'province_id' => 'required',
				'city' => 'required',
			], [
				"province_id" => [
					"required" => "Silakan isi Nama Provinsi"
				],
				"city" => [
					"required" => "Silakan isi Kota"
				],
			]);

			if (!$validation->withRequest($this->request)->run()) {
				//print_r($validation->getErrors());
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				$dat["id"]=$id;
				$MasterModel->edit_city($dat);
				session()->setFlashdata('success', "Kota berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		

		$provlist = $MasterModel->get_province_select();
		$data = [
			"page" => "edit_city",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"id" => $id,
			"provlist" => $provlist,
			"city" => $city

		];
		return view('master/edit_city',$data);
	}

	public function add_city()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'province_id' => 'required',
				'city' => 'required'
			], [
				"province_id" => [
					"required" => "Silakan isi Nama Provinsi"
				],
				"city" => [
					"required" => "Silakan isi Nama Kota"
				],
				
			]);

			if (!$validation->withRequest($this->request)->run()) {
				//print_r($validation->getErrors());
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				
				$MasterModel->add_city($dat);
				session()->setFlashdata('success', "Kota berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		

		$provlist = $MasterModel->get_province_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_city",
			"provlist" => $provlist
			
		];
		return view('master/add_city',$data);
	}
	
	public function get_city()
	{
		$MasterModel = new \App\Models\MasterModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$city_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($city_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$MasterModel->delete_city($city_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Kota berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$Kotalist = $MasterModel->get_cities();
		$data = [
			"page" => "get_city",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"citylist" => $Kotalist

		];
		return view('master/get_city',$data);
	}

	public function get_province()
	{
		$MasterModel = new \App\Models\MasterModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$province_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($province_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$MasterModel->delete_province($province_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Provinsi berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$provlist = $MasterModel->get_provinces();
		$data = [
			"page" => "get_provinces",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"provlist" => $provlist

		];
		return view('master/get_province',$data);
	}

	public function add_province()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $MasterModel->get_lecturers();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'province' => 'required',
			], [
				"province" => [
					"required" => "Silakan isi Nama Provinsi"
				]
			]);

			if (!$validation->withRequest($this->request)->run()) {
				//print_r($validation->getErrors());
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				$photo="";
				// if($_FILES["photo"]["name"]) {
				// 	$photo=$_FILES["photo"];
				// }
				// else {
				// 	$photo="";
				// }
				$MasterModel->add_province($dat);
				session()->setFlashdata('success', "Provinsi berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		


		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"page" => "add_province",

		];
		return view('master/add_province',$data);
	}

	public function edit_province($id)
	{
		helper('url');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$prov_list = $MasterModel->get_province_detail($id);
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'province' => 'required',
			], [
				"province" => [
					"required" => "Silakan isi Provinsi"
				]

			]);

			if (!$validation->withRequest($this->request)->run()) {
				//print_r($validation->getErrors());
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				$photo="";
				// if($_FILES["photo"]["name"]) {
				// 	$photo=$_FILES["photo"];
				// }
				// else {
				// 	$photo="";
				// }
				$dat["id"]=$id;
				$MasterModel->edit_province($dat);
				session()->setFlashdata('success', "Provinsi berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		


		$data = [
			"page" => "edit_province",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"id" => $id,
			"prov" => $prov_list

		];
		return view('master/edit_province',$data);
	}

	public function get_vaksin()
	{
		$MasterModel = new \App\Models\MasterModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$vaksin_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($vaksin_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$MasterModel->delete_vaksin($vaksin_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Vaksin berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$vaksinlist = $MasterModel->get_vaksin();
		$data = [
			"page" => "get_vaksin",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"vaksinlist" => $vaksinlist

		];
		return view('master/get_vaksins',$data);
	}

	public function add_vaksin()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$vaksinlist = $MasterModel->get_vaksin();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'vaksin_type' => 'required',
				'vaksin_name' => 'required',
			], [
				"vaksin_type" => [
					"required" => "Silakan isi Tipe Vaksin",
				],
				"vaksin_name" => [
					"required" => "Silakan isi Nama Vaksin"
				],
				
			]);

			if (!$validation->withRequest($this->request)->run()) {
				
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				$photo="";
				
				// if($_FILES["photo"]["name"]) {
				// 	$photo=$_FILES["photo"];
				// }
				// else {
				// 	$photo="";
				// }
				$MasterModel->add_vaksin($dat,$photo);
				session()->setFlashdata('success', "Vaksin berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		

		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_vaksin"

		];
		return view('master/add_vaksin',$data);
	}

	public function edit_vaksin($id)
	{
		helper('url');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'vaksin_type' => 'required',
				'vaksin_name' => 'required',
			], [
				"vaksin_type" => [
					"required" => "Silakan isi Tipe Vaksin",
				],
				"vaksin_name" => [
					"required" => "Silakan isi Nama Vaksin"
				],							

			]);

			if (!$validation->withRequest($this->request)->run()) {
				//print_r($validation->getErrors());
				// 	$resp = array(
				// 		"is_error" => 1,
				// 		"message" => "Silakan isi Nama Category"
				// 	);
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				$photo="";
				
				// if($_FILES["photo"]["name"]) {
				// 	$photo=$_FILES["photo"];
				// }
				// else {
				// 	$photo="";
				// }
				$dat["id"]=$id;
				$MasterModel->edit_vaksin($dat);
				session()->setFlashdata('success', "Data Vaksin berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$vaksin = $MasterModel->get_vaksin_detail($id);
		$data = [
			"page" => "edit_vaksin",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"id" => $id,
			"vaksin" => $vaksin,
			
		];
		return view('master/edit_vaksin',$data);
	}

	//--------------------------------------------------------------------

}
