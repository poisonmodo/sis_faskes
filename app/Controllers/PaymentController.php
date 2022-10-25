<?php

namespace App\Controllers;

class PaymentController extends AppController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function edit_payment($skripsi_id,$id)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$PaymentModel = new \App\Models\PaymentModel();
		$MasterModel = new \App\Models\MasterModel();
		$LecturersModel = new \App\Models\LecturersModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'tgl_bayar' => 'required',
				'param_id' => 'required',
				'biaya' => 'required|integer'
				
			], [
				"tgl_bayar" => [
					"required" => "Silakan isi Tanggal Bayar"
				],
				"param_id" => [
					"required" => "Silakan isi Keterangan"
				],
				"biaya" => [
					"required" => "Silakan isi biaya",
					"integer" => "Silakan Gunakan angka"
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
				$dat["id"] = $id;
				$dat["skripsi_id"]=$skripsi_id;
				$PaymentModel->edit_payment($dat);
				session()->setFlashdata('success', "Pembayaran berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$skripsi_id);
		}
		

		$paramlist = $PaymentModel->get_parameter();
		$detail = $PaymentModel->get_payment_detail($skripsi_id,$id);
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"skripsi_id" => $skripsi_id,
			"id" => $id,
			
			"page" => "edit_payment",
			"paramlist" => $paramlist,
			"payment" => $detail
		];
		return view('baak/edit_payment',$data);
	}

	public function add_payment($skripsi_id)
	{
		helper('url');
		helper('form');
		$uri = service('uri');
		$PaymentModel = new \App\Models\PaymentModel();
		$MasterModel = new \App\Models\MasterModel();
		$LecturersModel = new \App\Models\LecturersModel();
		$validation = \Config\Services::validation();
		//print_r($CategoryModel->get_category());
		//$lecturerslist = $LecturersModel->get_lecturers();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'tgl_bayar' => 'required',
				'param_id' => 'required',
				'biaya' => 'required|integer'
				
			], [
				"tgl_bayar" => [
					"required" => "Silakan isi Tanggal Bayar"
				],
				"param_id" => [
					"required" => "Silakan isi Keterangan"
				],
				"biaya" => [
					"required" => "Silakan isi biaya",
					"integer" => "Silakan Gunakan angka"
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
				$dat["skripsi_id"]=$skripsi_id;
				$PaymentModel->add_payment($dat);
				session()->setFlashdata('success', "Pembayaran berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$skripsi_id);
		}
		

		$paramlist = $PaymentModel->get_parameter();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"skripsi_id" => $skripsi_id,
			"page" => "add_payment",
			
			"paramlist" => $paramlist
		];
		return view('baak/add_payment',$data);
	}


    public function get_payment($skripsi_id) {
        helper('url');
		$uri = service('uri');
        $SkripsiModel = new \App\Models\SkripsiModel();
        $PaymentModel = new \App\Models\PaymentModel();
        $infoskripsi = $SkripsiModel->get_skripsi_detail($skripsi_id); 
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$payment_id_list =$dat["chkbox"];
			//print_r($catlist);
			$n = count($payment_id_list);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$PaymentModel->delete_payment($skripsi_id,$payment_id_list[$a]);
					
				}
				session()->setFlashdata('success', "Skripsi berhasil dihapus");
				//redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$skripsi_id);
			}
		}


        $paymentlist = $PaymentModel->get_payment($skripsi_id);    
        $data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"page" => "paymentlist",
			"infoskripsi" => $infoskripsi,
			"skripsi_id" => $skripsi_id,
            "paymentlist" => $paymentlist,
			
		];
        return view('baak/get_payment',$data);
    }
}
