<?php

namespace App\Controllers;

class MasterController extends AppController
{
	public function index()
	{
		//return view('welcome_message');
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
				session()->setFlashdata('success', "Mahasiswa berhasil dihapus");
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

	public function add_collegevaksin()
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
				'nim' => 'required|is_unique[mahasiswa.nim]',
				'nama_mahasiswa' => 'required',
				'jenis_kelamin' => 'required',
				'no_identitas' => 'required',
				'tempat_lahir' => 'required',
				'tgl_lahir' => 'required',
				'nama_ortu' => 'required',
				'alamat_ortu'	=> 'required',
				'Kota_id' => 'required',
				'tahun_akademik' => 'required',
			], [
				"nim" => [
					"required" => "Silakan isi NIM Mahasiswa",
					"is_unique" => "NIM mahasiswa harus unik",
					"integer" => "Gunakan Angka"
				],
				"nama_mahasiswa" => [
					"required" => "Silakan isi Nama Mahasiswa"
				],
				"no_identitas" => [
					"required" => "Silakan isi No KTP"
				],
				"jenis_kelamin" => [
					"required" => "Silakan isi Jenis Kelamin"
				],
				"tempat_lahir" => [
					"required" => "Silakan isi Tempat Lahir"
				],
				"tgl_lahir" => [
					"required" => "Silakan isi Tanggal Lahir"
				],
				"nama_ortu" => [
					"required" => "Silakan isi Nama Orang Tua/Wali"
				],
				"alamat_ortu" => [
					"required" => "Silakan isi Alamat Orang Tua/Wali"
				],
				"Kota_id" => [
					"required" => "Silakan isi Kota"
				],
				"tahun_akademik" => [
					"required" => "Silakan isi Tahun Akademik"
				]							

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
				
				if($_FILES["photo"]["name"]) {
					$photo=$_FILES["photo"];
				}
				else {
					$photo="";
				}
				$MasterModel->add_vaksins($dat,$photo);
				session()->setFlashdata('success', "Mahasiswa berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		

		$Kotalist = $MasterModel->get_city_select(); 
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"Kotalist" => $Kotalist,
			"page" => "add_vaksin"

		];
		return view('master/add_vaksins',$data);
	}

	public function edit_collegevaksin($id)
	{
		helper('url');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'nim' => 'required',
				'nama_mahasiswa' => 'required',
				'jenis_kelamin' => 'required',
				'no_identitas' => 'required',
				'tempat_lahir' => 'required',
				'tgl_lahir' => 'required',
				'nama_ortu' => 'required',
				'alamat_ortu'	=> 'required',
				'Kota_id' => 'required',
				'tahun_akademik' => 'required',
			], [
				"nim" => [
					"required" => "Silakan isi NIM Mahasiswa",
					"integer" => "Gunakan Angka"
				],
				"nama_mahasiswa" => [
					"required" => "Silakan isi Nama Mahasiswa"
				],
				"no_identitas" => [
					"required" => "Silakan isi No KTP"
				],
				"jenis_kelamin" => [
					"required" => "Silakan isi Jenis Kelamin"
				],
				"tempat_lahir" => [
					"required" => "Silakan isi Tempat Lahir"
				],
				"tgl_lahir" => [
					"required" => "Silakan isi Tanggal Lahir"
				],
				"nama_ortu" => [
					"required" => "Silakan isi Nama Orang Tua/Wali"
				],
				"alamat_ortu" => [
					"required" => "Silakan isi Alamat Orang Tua/Wali"
				],
				"Kota_id" => [
					"required" => "Silakan isi Kota"
				],
				"tahun_akademik" => [
					"required" => "Silakan isi Tahun Akademik"
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
				
				if($_FILES["photo"]["name"]) {
					$photo=$_FILES["photo"];
				}
				else {
					$photo="";
				}
				$dat["id"]=$id;
				$MasterModel->edit_vaksins($dat,$photo);
				session()->setFlashdata('success', "Data Mahasiswa berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$Kotalist = $MasterModel->get_city_select(); 
		$vaksin = $MasterModel->get_vaksin_detail($id);
		$data = [
			"page" => "edit_vaksin",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"id" => $id,
			"vaksin" => $vaksin,
			"Kotalist" => $Kotalist

		];
		return view('master/edit_vaksins',$data);
	}

	//--------------------------------------------------------------------

}
