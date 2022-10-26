<?php

namespace App\Controllers;

class InfoController extends AppController
{
	public function index()
	{
		return view('welcome_message');
    }

	public function get_faskes_vaksin()
	{
		$InfoModel = new \App\Models\InfoModel();
		
		helper('url');
		$uri = service('uri');
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$vaksin_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($vaksin_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$InfoModel->delete_faskes_vaksin($vaksin_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Vaksin berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$vaksinlist = $InfoModel->get_faskes_vaksin();
		$data = [
			"page" => "get_faskes_vaksin",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			
			"infolist" => $vaksinlist

		];
		return view('info/get_faskes_vaksin',$data);
	}

	public function get_vaksin($faskes_id)
	{
		$InfoModel = new \App\Models\InfoModel();
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
					$InfoModel->delete_vaksin($vaksin_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Vaksin berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
		}

		//print_r($CategoryModel->get_category());
		$vaksinlist = $InfoModel->get_vaksin($faskes_id);
		$info_faskes = $MasterModel->get_faskes_name($faskes_id);
		$data = [
			"page" => "get_vaksin2",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"info_faskes" => $info_faskes,
			"vaksinlist" => $vaksinlist,
			"faskes_id" => $faskes_id
		];
		return view('info/get_vaksins',$data);
	}

	public function add_vaksin($faskes_id)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$InfoModel = new \App\Models\InfoModel();
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		$vaksinlist = $InfoModel->get_vaksin($faskes_id);
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'vaksin_id' => 'required|integer',
				'kouta' => 'required|integer',
			], [
				"vaksin_id" => [
					"required" => "Silakan isi Vaksin",
					"integer" => "Silakan isi kouta dengan amgka"
				],
				"kouta" => [
					"required" => "Silakan isi kouta",
					"integer" => "Silakan isi kouta dengan amgka"
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
				$dat["faskes_id"]=$faskes_id;
				$respon =$InfoModel->add_faskes_vaksin($dat);
				if($respon["is_error"]==0) {
					session()->setFlashdata('success', $respon["message"]);
				}
				else {
					session()->setFlashdata('errors', $respon["message"]);
					
				}
			}
			
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3)."/".$uri->getSegment(4));
		}

		$info_faskes = $MasterModel->get_faskes_name($faskes_id);
		$vaksinlist = $MasterModel->get_vaksin_select();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "add_vaksin",
			"vaksinlist" => $vaksinlist,
			"faskes_id" => $faskes_id,
			"info_faskes" => $info_faskes,
		];
		return view('info/add_vaksin',$data);
	}

	public function edit_vaksin($faskes_id,$id)
	{
		helper('url');
		
		$uri = service('uri');
		$InfoModel = new \App\Models\InfoModel();
		$MasterModel = new \App\Models\MasterModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'vaksin_id' => 'required|integer',
				'kouta' => 'required|integer',
			], [
				"vaksin_id" => [
					"required" => "Silakan isi Vaksin",
					"integer" => "Silakan isi kouta dengan amgka"
				],
				"kouta" => [
					"required" => "Silakan isi kouta",
					"integer" => "Silakan isi kouta dengan amgka"
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
				$dat["faskes_id"]=$faskes_id;
				$respon = $InfoModel->edit_faskes_vaksin($dat);
				if($respon["is_error"]==0) {
					session()->setFlashdata('success', $respon["message"]);
				}
				else {
					session()->setFlashdata('errors', $respon["message"]);
					
				}
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3)."/".$uri->getSegment(4)."/".$uri->getSegment(5));
		}
		
		$info_faskes = $MasterModel->get_faskes_name($faskes_id);
		$vaksinlist = $MasterModel->get_vaksin_select();
		$fvaksin = $InfoModel->get_vaksin_detail($id);
		$data = [
			"page" => "edit_vaksin",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"vaksinlist" => $vaksinlist,
			"faskes_id" => $faskes_id,			
			"id" => $id,
			"fvaksin" => $fvaksin,
			"info_faskes" => $info_faskes,			
			
		];
		return view('info/edit_vaksin',$data);
	}
}