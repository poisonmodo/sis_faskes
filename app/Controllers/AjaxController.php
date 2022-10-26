<?php

namespace App\Controllers;

class AjaxController extends BaseController
{
	public function get_mhs_checklist_count()
	{
		$CheckListModel = new \App\Models\CheckListModel();
		$dat = $this->request->getPost();
		//print_r($dat);
		$hasil =$CheckListModel->get_mhs_parameter_count($dat["nim"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
					"is_error" => 0,
					"lengkap" => $hasil["lengkap"],
					"message" => $hasil["message"],
					"total" => $hasil["total"]
				)
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"lengkap" => $hasil["lengkap"],
				"message" => $hasil["message"],
				"total" => 0
			));
		}
	
		exit();
	}
	
	public function delete_checklist()
	{
		$ChecklistModel = new \App\Models\ChecklistModel();
		$dat = $this->request->getPost();
		
		$hasil =$ChecklistModel->delete_checklist($dat["skripsi_id"],$dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function delete_payment()
	{
		$PaymentModel = new \App\Models\PaymentModel();
		$dat = $this->request->getPost();
		
		$hasil =$PaymentModel->delete_Payment($dat["skripsi_id"],$dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}


	public function delete_skripsi_dosen()
	{
		$SkripsiModel = new \App\Models\SkripsiModel();
		$dat = $this->request->getPost();
		
		$hasil =$SkripsiModel->delete_skripsi_dosen($dat["skripsi_id"],$dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function delete_lesson()
	{
		$MasterModel = new \App\Models\MasterModel();
		$dat = $this->request->getPost();
		
		$hasil =$MasterModel->delete_lesson($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}
	
	public function delete_province()
	{
		$MasterModel = new \App\Models\MasterModel();
		$dat = $this->request->getPost();
		
		$hasil =$MasterModel->delete_province($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function delete_yudisium()
	{
		$YudisumModel = new \App\Models\YudisiumModel();
		$dat = $this->request->getPost();
		
		$hasil =$YudisumModel->delete_yudisium($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function delete_city()
	{
		$MasterModel = new \App\Models\MasterModel();
		$dat = $this->request->getPost();
		
		$hasil =$MasterModel->delete_city($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function get_student_by_nim()
	{
		$MasterModel = new \App\Models\MasterModel();
		$dat = $this->request->getPost();
		$hasil =$MasterModel->get_student_by_nim($dat["nim"]);
		if($hasil) {

			echo json_encode(array(
				"is_error" => 0,
				"message" => "Data found",
				"data" => $hasil
			));
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function get_student_detail()
	{
		$MasterModel = new \App\Models\MasterModel();
		$dat = $this->request->getPost();
		$hasil =$MasterModel->get_student_detail2($dat["nim"]);
		if($hasil) {

			echo json_encode(array(
				"is_error" => 0,
				"message" => "Data found",
				"data" => $hasil
			));
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function get_student_list()
	{
		$MasterModel = new \App\Models\MasterModel();
		
		$hasil =$MasterModel->get_student_select();
		if($hasil) {

			echo json_encode(array(
				"is_error" => 0,
				"message" => "Data found",
				"data" => $hasil
			));
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}

	public function delete_skripsi()
	{
		$SkripsiModel = new \App\Models\SkripsiModel();
		$dat = $this->request->getPost();
		
		$hasil =$SkripsiModel->delete_skripsi($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
	}
	
	public function delete_faskes()
	{
		$MasterModel = new \App\Models\MasterModel();
		$dat = $this->request->getPost();
		
		$hasil =$MasterModel->delete_faskes($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
    }
	
	public function delete_vaksin()
	{
		$MasterModel = new \App\Models\MasterModel();
		$dat = $this->request->getPost();
		
		$hasil =$MasterModel->delete_vaksin($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
    }

	public function delete_faskes_vaksin()
	{
		$infoModel = new \App\Models\infoModel();
		$dat = $this->request->getPost();
		
		$hasil =$infoModel->delete_faskes_vaksin($dat["id"]);
			if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
    }

	public function delete_user()
	{
		$UsersModel = new \App\Models\UsersModel();
		$dat = $this->request->getPost();
		
		$hasil =$UsersModel->delete_users($dat["id"]);
		if($hasil["is_error"]==0) {
			echo json_encode(array(
				"is_error" => 0,
				"message" => $hasil["message"])
			);
		}
		else {
			echo json_encode(array(
				"is_error" => 1,
				"message" => $hasil["message"]
			));
		}
	
		exit();
    }
}
