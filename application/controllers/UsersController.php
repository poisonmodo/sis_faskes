<?php

namespace App\Controllers;

class UsersController extends CI_Controller
{
	public function index()
	{
		return view('welcome_message');
	}

	
	public function login()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('MY_API');
		//$session = session();
		
		if($this->input->post('loginbtn')) {
			$dat = $this->input->post();
			$validation->setRules([
				'email' => 'required',
				'userpass' => 'required',
				
			], [
				"email" => [
					"required" => "Silakan isi email"
				],
				"userpass" => [
					"required" => "Silakan isi password"
				],
				
			]);

			if (!$validation->withRequest($this->request)->run()) {
				session()->setFlashdata('errors', $validation->getErrors());
			}
			else {
				$res=$this->MY_API->send_post('login',$dat);
				if($res["is_error"]==0) {
					session()->setFlashdata('success',$res["message"]);
					$security = array("security" => array(
						"usrkey" => sha1($dat["email"].date("YmdHis")),
						"uid" => $res["data"]->id,
						"uname" => $res["data"]->email,
						"group_id" => $res["data"]->group_id 	
					));
					$session->set($security);
					echo "<script>location.href='".site_url('home')."'</script>";
				}
				else {
					session()->setFlashdata('error_message', $res["message"]);
					echo "<script>location.href='".site_url('login')."'</script>";
					
				}
				exit();
			}
		}

		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"]
		];
		return view('users/login',$data);
	}

	public function add_user()
	{
		helper('form');
		$uri = service('uri');
		$validation = \Config\Services::validation();
		$is_error = 0;
		$UsersModel = new \App\Models\UsersModel();
		if ($this->request->getPost('addbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'email' => 'required',
				'userpass' => 'required|min_length[6]',
				'group_id' => 'required',
			], [
				"email" => [
					"required" => "Silakan isi email"
				],
				"userpass" => [
					"required" => "Silakan isi password"
				],
				"group_id" => [
					"required" => "Silakan isi Group User"
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
				$UsersModel->add_users($dat);
				session()->setFlashdata('success', "User berhasil ditambahkan");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}

		$grouplist = $UsersModel->get_group_all();
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"groupslist" => $grouplist,
			"page" => "add_user",
			"uname" => $this->viewdata["uname"]
		];
		return view('users/add_users', $data);
	}

	public function edit_user($id)
	{
		helper('form');
		$uri = service('uri');
		$validation = \Config\Services::validation();
		$is_error = 0;
		$UsersModel = new \App\Models\UsersModel();
		if ($this->request->getPost('editbtn')) {
			$dat = $this->request->getPost();
			$validation->setRules([
				'email' => 'required',
				'group_id' => 'required',
			], [
				"email" => [
					"required" => "Silakan isi email"
				],
				"group_id" => [
					"required" => "Silakan isi Group User"
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
				$UsersModel->edit_users($dat);
				session()->setFlashdata('success', "User berhasil diupdate");
			}
			redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3));
		}

		$usr = $UsersModel->get_user_detail($id);
		$grouplist = $UsersModel->get_group_all();
		//print_r($usr);
		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"groupslist" => $grouplist,
			"uid" => $id,
			"page" => "edit_user",
			"uname" => $this->viewdata["uname"],
			"usr" => $usr
		];
		return view('users/edit_users', $data);
	}

	public function get_user_list() {
		helper('form');
		helper('url');
		$uri = service('uri');
		$session = session();
		$validation = \Config\Services::validation();
		$SettingsModel = new \App\Models\SettingsModel();        
        $settings= $SettingsModel->get_settings();
		
		$UsersModel = new \App\Models\UsersModel();
		foreach($settings as $setup) {
            $this->settings[$setup->option_name]=$setup->option_value;
		}
		
		if($this->request->getPost('delall')) {
			$dat = $this->request->getPost();
			$userslist =$dat["chkbox"];
			//print_r($catlist);
			$n = count($userslist);
			if($n>0) {
				for($a=0;$a<$n;$a++) {
					$UsersModel->delete_users($userslist[$a]);
					
				}
				session()->setFlashdata('success', "User berhasil dihapus");
				redirect()->to($uri->getSegment(1)."/".$uri->getSegment(2));
			}
			
		}



		$userslist = $UsersModel->get_user_list();
		$data = [
			"page" => "userslist",
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"userlist" => $userslist,
			"uname" => $this->viewdata["uname"]
		];
		return view('users/get_user_list',$data);
	}

	public function logout() {
		helper('url');
		$uri = service('uri');
		$session = session();
		$sess = $session->get('security');
		if(isset($sess["usrkey"])) {
			$session->remove("security");
			$session->destroy();
		}
		echo "<script>location.href='".site_url('login')."'</script>";
	}
	//--------------------------------------------------------------------

}
