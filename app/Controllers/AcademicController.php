<?php

namespace App\Controllers;

class AcademicController extends AppController
{
	public function index()
	{
		//return view('welcome_message');
	}


	public function edit_jurusan($id)
	{
		helper('url');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$jurusan = $CollegeStudentModel->get_jurusan_detail($id);
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'jurusan' => 'required',
			], [
				"jurusan" => [
					"required" => "Silakan isi Jurusan"
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
				$CollegeStudentModel->edit_jurusan($dat);
				session()->setFlashdata('success', "Jurusan berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		


		$data = [
			"page" => "edit_jurusan",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"id" => $id,
			"group_id" => $this->viewdata["group_id"],
			"jurusan" => $jurusan

		];
		return view('academics/edit_jurusan',$data);
	}

	public function add_jurusan()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$validation = \Config\Services::validation();
		
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'jurusan' => 'required'
			], [
				"jurusan" => [
					"required" => "Silakan isi Nama Jurusan"
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
				
				$CollegeStudentModel->add_jurusan($dat);
				session()->setFlashdata('success', "Jurusan berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		


		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_jurusan",
			"group_id" => $this->viewdata["group_id"],
		];
		return view('academics/add_jurusan',$data);
	}
	
	public function get_jurusan()
	{
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$jurusan_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($jurusan_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$CollegeStudentModel->delete_jurusan($jurusan_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Jurusan berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$jurusanlist = $CollegeStudentModel->get_jurusan();
		$data = [
			"page" => "jurusanlist",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"jurusanlist" => $jurusanlist

		];
		return view('academics/get_jurusan',$data);
	}

	public function get_document()
	{
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$lectuers_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($lectuers_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$CollegeStudentModel->delete_document($lectuers_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Dokumen berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$docslist = $CollegeStudentModel->get_documents();
		$data = [
			"page" => "documentlist",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"docslist" => $docslist

		];
		return view('academics/get_document',$data);
	}

	public function add_documents()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $CollegeStudentModel->get_lecturers();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'nama_dokumen' => 'required',
			], [
				"nama_dokumen" => [
					"required" => "Silakan isi Nama Dokumen"
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
				$CollegeStudentModel->add_documents($dat);
				session()->setFlashdata('success', "Dokumen berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		


		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"page" => "add_documents",

		];
		return view('academics/add_documents',$data);
	}

	public function edit_documents($id)
	{
		helper('url');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$docs_list = $CollegeStudentModel->get_documents_detail($id);
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'nama_dokumen' => 'required',
			], [
				"nama_dokumen" => [
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
				$photo="";
				// if($_FILES["photo"]["name"]) {
				// 	$photo=$_FILES["photo"];
				// }
				// else {
				// 	$photo="";
				// }
				$dat["id"]=$id;
				$CollegeStudentModel->edit_documents($dat);
				session()->setFlashdata('success', "Dokumen berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		


		$data = [
			"page" => "edit_documents",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"id" => $id,
			"docs" => $docs_list

		];
		return view('academics/edit_documents',$data);
	}

	public function get_collegestudent()
	{
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$student_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($student_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$CollegeStudentModel->delete_student($student_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Mahasiswa berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$studentlist = $CollegeStudentModel->get_student();
		$data = [
			"page" => "studentlist",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"studentlist" => $studentlist

		];
		return view('academics/get_students',$data);
	}

	public function add_collegestudent()
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$studentlist = $CollegeStudentModel->get_student();
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
				'jurusan_id' => 'required',
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
				"jurusan_id" => [
					"required" => "Silakan isi jurusan"
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
				$CollegeStudentModel->add_students($dat,$photo);
				session()->setFlashdata('success', "Mahasiswa berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		

		$jurusanlist = $CollegeStudentModel->get_jurusan_select(); 
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"jurusanlist" => $jurusanlist,
			"page" => "add_student"

		];
		return view('academics/add_students',$data);
	}

	public function edit_collegestudent($id)
	{
		helper('url');
		$uri = service('uri');
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();
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
				'jurusan_id' => 'required',
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
				"jurusan_id" => [
					"required" => "Silakan isi jurusan"
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
				$CollegeStudentModel->edit_students($dat,$photo);
				session()->setFlashdata('success', "Data Mahasiswa berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}
		
		$jurusanlist = $CollegeStudentModel->get_jurusan_select(); 
		$student = $CollegeStudentModel->get_student_detail($id);
		$data = [
			"page" => "edit_student",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"id" => $id,
			"student" => $student,
			"jurusanlist" => $jurusanlist

		];
		return view('academics/edit_students',$data);
	}

	//--------------------------------------------------------------------

}
