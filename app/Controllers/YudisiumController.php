<?php

namespace App\Controllers;

class YudisiumController extends AppController
{
	public function index()
	{
		return view('welcome_message');
    }

	public function edit_ijazah($nim,$id)
	{
		helper('url');
		$uri = service('uri');
		$YudisiumModel = new \App\Models\YudisiumModel();
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$ijazah = $YudisiumModel->get_ijazah_detail($id);
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'tanggal_yudisium' => 'required',
				'tanggal_ijazah' => 'required',
				'no_ijazah' => 'required',
			], [
				"tanggal_yudisium" => [
					"required" => "Silakan isi Tanggal Yudisium"
				],
				"tanggal_ijazah" => [
					"required" => "Silakan isi Tanggal Ijazah"
				],
				"no_ijazah" => [
					"required" => "Silakan isi No Ijazah"
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
				if($_FILES["photo"]["name"]) {
					$photo=$_FILES["photo"];
				}
				else {
					$photo="";
				}

				$dat["id"]=$id;
				$dat["nim"]=$nim;
				$YudisiumModel->edit_ijazah($dat,$photo);
				session()->setFlashdata('success', "Ijazah qq berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$dat["nim"]= $nim;
		$student_name = $CollegeStudentModel->get_student_name($nim);
		$mhslist = $CollegeStudentModel->get_student_select();
		$data = [
			"page" => "edit_ijazah",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"id" => $id,
			"group_id" => $this->viewdata["group_id"],
			"ijazah" => $ijazah,
			"mhslist" => $mhslist,
			"nim" => $nim,
			"student_name" => $student_name

		];
		return view('baak/edit_ijazah',$data);
	}

	public function add_ijazah($nim)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$YudisiumModel = new \App\Models\YudisiumModel();
		$validation = \Config\Services::validation();
		
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'tanggal_yudisium' => 'required',
				'tanggal_ijazah' => 'required',
				'no_ijazah' => 'required',
			], [
				"tanggal_yudisium" => [
					"required" => "Silakan isi Tanggal Yudisium"
				],
				"tanggal_ijazah" => [
					"required" => "Silakan isi Tanggal Ijazah"
				],
				"no_ijazah" => [
					"required" => "Silakan isi No Ijazah"
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
				if($_FILES["photo"]["name"]) {
					$photo=$_FILES["photo"];
				}
				else {
					$photo="";
				}
				$dat["nim"]= $nim;
				$YudisiumModel->add_ijazah($dat,$photo);
				session()->setFlashdata('success', "Ijazah berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$nim);
		}
		
		$student_name = $CollegeStudentModel->get_student_name($nim);
		$mhslist = $CollegeStudentModel->get_student_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_ijazah",
			"group_id" => $this->viewdata["group_id"],
			"mhslist" => $mhslist,
			"nim" => $nim,
			"student_name" => $student_name
		];
		return view('baak/add_ijazah',$data);
	}

	public function get_ijazah($nim)
	{
		$YudisiumModel = new \App\Models\YudisiumModel();
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();

		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$yudisium_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($yudisium_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$YudisiumModel->delete_ijazah($yudisium_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Ijazah berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$ijazahlist = $YudisiumModel->get_ijazah($nim);
		$student_name = $CollegeStudentModel->get_student_name($nim);
		$data = [
			"page" => "ijazahlist",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"ijazahlist" => $ijazahlist,
			"nim" => $nim,
			"student_name" => $student_name

		];
		return view('baak/get_ijazah',$data);
	}


    public function edit_yudisium($nim,$id)
	{
		helper('url');
		$uri = service('uri');
		$YudisiumModel = new \App\Models\YudisiumModel();
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$yudisium = $YudisiumModel->get_yudisium_detail($id);
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'id_dokumen' => 'required',
			], [
				"id_dokumen" => [
					"required" => "Silakan isi Nama Dokumen"
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
				if($_FILES["photo"]["name"]) {
					$photo=$_FILES["photo"];
				}
				else {
					$photo="";
				}

				$dat["id"]=$id;
				$dat["nim"]=$nim;
				$YudisiumModel->edit_yudisium($dat,$photo);
				session()->setFlashdata('success', "yudisium berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$dat["nim"]= $nim;
		$student_name = $CollegeStudentModel->get_student_name($nim);
		$mhslist = $CollegeStudentModel->get_student_select();
		$docslist = $CollegeStudentModel->get_documents_select();
		$data = [
			"page" => "edit_yudisium",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"id" => $id,
			"group_id" => $this->viewdata["group_id"],
			"yudisium" => $yudisium,
			"docslist" => $docslist,
			"mhslist" => $mhslist,
			"nim" => $nim,
			"student_name" => $student_name

		];
		return view('baak/edit_yudisium',$data);
	}

	public function add_yudisium($nim)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$YudisiumModel = new \App\Models\YudisiumModel();
		$validation = \Config\Services::validation();
		
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'id_dokumen' => 'required',
			], [
				"id_dokumen" => [
					"required" => "Silakan isi Nama Dokumen"
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
				if($_FILES["photo"]["name"]) {
					$photo=$_FILES["photo"];
				}
				else {
					$photo="";
				}
				$dat["nim"]= $nim;
				$YudisiumModel->add_yudisium($dat,$photo);
				session()->setFlashdata('success', "Yudisium berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$student_name = $CollegeStudentModel->get_student_name($nim);
		$mhslist = $CollegeStudentModel->get_student_select();
		$docslist = $CollegeStudentModel->get_documents_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_yudisium",
			"group_id" => $this->viewdata["group_id"],
			"docslist" => $docslist,
			"mhslist" => $mhslist,
			"nim" => $nim,
			"student_name" => $student_name
		];
		return view('baak/add_yudisium',$data);
	}
	
	public function get_yudisium($nim)
	{
		$YudisiumModel = new \App\Models\YudisiumModel();
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();

		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$yudisium_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($yudisium_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$YudisiumModel->delete_yudisium($yudisium_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Yudisium berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$yudisiumlist = $YudisiumModel->get_yudisium($nim);
		$student_name = $CollegeStudentModel->get_student_name($nim);
		$data = [
			"page" => "yudisiumlist",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"yudisiumlist" => $yudisiumlist,
			"nim" => $nim,
			"student_name" => $student_name

		];
		return view('baak/get_yudisium',$data);
	}

	public function get_students($bagian)
	{
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		
		helper('url');
		$uri = service('uri');
		
		//print_r($CategoryModel->get_category());
		$studentlist = $CollegeStudentModel->get_student();
		$data = [
			"page" => "studentlist",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"studentlist" => $studentlist,
			"bagian" => $bagian

		];
		return view('baak/get_students',$data);
	}
}