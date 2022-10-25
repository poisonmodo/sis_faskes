<?php

namespace App\Controllers;

class SkripsiController extends AppController
{
	public function index()
	{
		return view('welcome_message');
    }

	public function add_ijazah()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'nim' => 'required',
				'no_ijazah' => 'required',
				'tgl_lulus' => 'required'
			], 
			[
					"nim" => [
						"required" => "Silakan isi NIM Mahasiswa"
			  	 	],
			   		"no_ijazah" => [
							"required" => "Silakan isi No Ijazah"
					],
					"tgl_lulus" => [
						"required" => "Silakan isi Tanggal Lulus"
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
				
				$MasterModel->add_ijazah($dat);
				session()->setFlashdata('success', "Jiazah berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3)."/".$uri->getSegment(4));
		}
		

		$mhs = $MasterModel->get_student_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_jiazah",
			"mhslist" =>  $mhs,
			
		];
		return view('baak/add_jiazah',$data);
	}

	public function get_skripsi_dosen($id) {
		helper('url');
		$uri = service('uri');
		$SkripsiModel = new \App\Models\SkripsiModel();
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$skripsi_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($skripsi_id_list);
			if($n>0) {
				$skripsi_id=$id;
				for($a=0;$a<$n;$a++) {
					$SkripsiModel->delete_skripsi_dosen($skripsi_id,$skripsi_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Dosen berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		$infoskripsi = $SkripsiModel->get_skripsi_detail($id);
		$dosenlist = $SkripsiModel->get_skripsi_dosen($id);
        $data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
            "dosenlist" => $dosenlist,
			"page" => "skripsi_dosen_list",
			
			"skripsi_id" => $id,
			"infoskripsi" => $infoskripsi
		];
        return view('baak/get_skripsi_dosen',$data);
    }

	public function add_skripsi_dosen($id)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$SkripsiModel = new \App\Models\SkripsiModel();
		$MasterModel = new \App\Models\MasterModel();
		$LecturersModel = new \App\Models\LecturersModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'nik' => 'required',
				'posisi' => 'required',
				
			], [
				"nik" => [
					"required" => "Silakan isi Nama dosen"
				],
				"posisi" => [
					"required" => "Silakan isi Posisi"
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
				$dat["skripsi_id"] =$id;
				$SkripsiModel->add_skripsi_dosen($dat);
				session()->setFlashdata('success', "Dosen berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$infoskripsi = $SkripsiModel->get_skripsi_detail($id);
		$dosenlist = $LecturersModel->get_lecturer_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"dosenlist" => $dosenlist,
			"id" => $id,
			
			"page" => "add_skripsi_dosen",
			"infoskripsi" => $infoskripsi
		];
		return view('baak/add_skripsi_dosen',$data);
	}

	public function edit_skripsi_dosen($skripsi_id,$id)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$SkripsiModel = new \App\Models\SkripsiModel();
		$MasterModel = new \App\Models\MasterModel();
		$LecturersModel = new \App\Models\LecturersModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'nik' => 'required',
				'posisi' => 'required',
				
			], [
				"nik" => [
					"required" => "Silakan isi Nama dosen"
				],
				"posisi" => [
					"required" => "Silakan isi Posisi"
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
				$dat["skripsi_id"] =$skripsi_id;
				$dat["id"] =$id;
				$SkripsiModel->edit_skripsi_dosen($dat);
				session()->setFlashdata('success', "Dosen berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3)."/".$skripsi_id);
		}
		
		$infoskripsi = $SkripsiModel->get_skripsi_detail($id);
		$dosenlist = $LecturersModel->get_lecturer_select();
		$dosen_skripsi = $SkripsiModel->get_skripsi_dosen_detail($skripsi_id,$id);
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"dosenlist" => $dosenlist,
			"dosen_skripsi" => $dosen_skripsi,
			"skripsi_id" => $skripsi_id,
			"id" => $id,
			
			"page" => "edit_skripsi_dosen",
			"infoskripsi" => $infoskripsi
		];
		return view('baak/edit_skripsi_dosen',$data);
	}

	public function edit_skripsi($id)
	{
		helper('url');
		$uri = service('uri');
		$SkripsiModel = new \App\Models\SkripsiModel();
		$MasterModel = new \App\Models\MasterModel();
		$LecturersModel = new \App\Models\LecturersModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'judul_skripsi' => 'required',
				'nim' => 'required',
				
			], [
				"judul_skripsi" => [
					"required" => "Silakan isi Judul Skripsi"
				],
				"nim" => [
					"required" => "Silakan isi Nama Mahasiswa"
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
				$SkripsiModel->edit_skripsi($dat);
				session()->setFlashdata('success', "Skripsi berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$skripsi = $SkripsiModel->get_skripsi_detail($id);
		// print_r($skripsi);
		// exit();
		$dosenlist = $LecturersModel->get_lecturer_select();
		$mhs = $MasterModel->get_student_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"id" => $id,
			"dosenlist" => $dosenlist,
			"skripsi" => $skripsi,
			"mhslist" => $mhs,
			
			"page" => "edit_skripsi",
		];
		return view('baak/edit_skripsi',$data);
	}

	public function add_skripsi()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$SkripsiModel = new \App\Models\SkripsiModel();
		$MasterModel = new \App\Models\MasterModel();
		$LecturersModel = new \App\Models\LecturersModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'judul_skripsi' => 'required',
				'nim' => 'required',
				
			], [
				"judul_skripsi" => [
					"required" => "Silakan isi Judul Skripsi"
				],
				"nim" => [
					"required" => "Silakan isi Nama Mahasiswa"
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
				$SkripsiModel->add_skripsi($dat);
				session()->setFlashdata('success', "Skripsi berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		

		$dosenlist = $LecturersModel->get_lecturer_select();
		$studentlist = $MasterModel->get_student_select(); 
		$mhs = $MasterModel->get_student_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"dosenlist" => $dosenlist,
			"studentlist" => $studentlist,
			"mhslist" => $mhs,
			
			"page" => "add_skripsi",
		];
		return view('baak/add_skripsi',$data);
	}

	public function get_skripsi() {
		helper('url');
		$uri = service('uri');
		$SkripsiModel = new \App\Models\SkripsiModel();
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$skripsi_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($skripsi_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$SkripsiModel->delete_skripsi($skripsi_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Skripsi berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		$skripsilist = $SkripsiModel->get_skripsi();
        $data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
            "skripsilist" => $skripsilist,
			"page" => "skripsilist",
			
		];
        return view('baak/get_skripsi',$data);
    }

	public function get_checklist($skripsi_id) {
		helper('url');
		$uri = service('uri');
		$CheckListModel = new \App\Models\CheckListModel();
		$SkripsiModel = new \App\Models\SkripsiModel();

		$checklist = $CheckListModel->get_checklist($skripsi_id);
		$jml_param= $CheckListModel->get_parameter_count()->jml;
		$infoskripsi = $SkripsiModel->get_skripsi_detail($skripsi_id);
		//echo $jml_param;
        $data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
            "checklist" => $checklist,
			"jml_param" => $jml_param,
			"page" => "checklist",
			"infoskripsi" => $infoskripsi,
			
			"skripsi_id" => $skripsi_id
		];
        return view('baak/get_checklist',$data);
    }

	public function add_checklist($skripsi_id)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$CheckListModel= new \App\Models\CheckListModel();
		$MasterModel = new \App\Models\MasterModel();
		$SkripsiModel = new \App\Models\SkripsiModel();
		$infoskripsi = $SkripsiModel->get_skripsi_detail($skripsi_id);
		//	print_r($infoskripsi);
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'param_id' => 'required'
				
			], [
				"param_id" => [
					"required" => "Silakan isi Keterangan"
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
				$docs="";
				// if($_FILES["photo"]["name"]) {
				// 	$photo=$_FILES["photo"];
				// }
				// else {
				// 	$photo="";
				// }
				$docs = $_FILES["document"];
				// print_r("<pre />");
				// print_r($docs);
				$dat["skripsi_id"] = $skripsi_id;
				$dat["nim"] = $infoskripsi->nim;
				$CheckListModel->add_checklist($dat,$docs);
				session()->setFlashdata('success', "Dokumen berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$skripsi_id);
		}
		
		$paramlist = $CheckListModel->get_parameter();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_checklist",
			"skripsi_id" => $skripsi_id,
			
			"paramlist" => $paramlist
		];
		return view('baak/add_checklist',$data);
	}

	public function edit_checklist($skripsi_id,$id)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$CheckListModel= new \App\Models\CheckListModel();
		$MasterModel = new \App\Models\MasterModel();
		$SkripsiModel = new \App\Models\SkripsiModel();
		$infoskripsi = $SkripsiModel->get_skripsi_detail($skripsi_id);
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'param_id' => 'required'
				
			], [
				"param_id" => [
					"required" => "Silakan isi Keterangan"
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
				$docs="";
				$docs = $_FILES["document"];
				$dat["skripsi_id"] = $skripsi_id;
				$dat["nim"] = $infoskripsi->nim;
				$dat["id"] = $id;
				// print_r("<pre />");
				// print_r($docs);
				$CheckListModel->edit_checklist($dat,$docs);
				session()->setFlashdata('success', "Dokumen berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$skripsi_id);
		}
		
		$paramlist = $CheckListModel->get_parameter();
		$detail = $CheckListModel->get_checklist_detail($skripsi_id,$id);
		// print_r('<pre />');
		// print_r($detail);
		// exit();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "edit_checklist",
			"paramlist" => $paramlist,
			"detail" => $detail,
			"id" => $id,
			
			"skripsi_id" => $skripsi_id
		];
		return view('baak/edit_checklist',$data);
	}

}