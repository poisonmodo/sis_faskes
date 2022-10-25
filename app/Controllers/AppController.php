<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AppController extends Controller
{
    public $settings;
    public $viewdata;
    public function __construct() {
        helper('url');
        $uri = service('uri');
        $session = session();
        $sess = $session->get('security');
     
        $this->viewdata =false;
        if($uri->getSegment(1)!='login') {
            if(!isset($sess["usrkey"])) {
                echo "<script>location.href='".site_url('login')."'</script>";
            }
            else {
                $this->viewdata = array(
                    "uname" => $sess["uname"],
                    "uid" => $sess["uid"],
                    // "group_id" => $sess["group_id"]
                );
            }
        }
       
        $SettingsModel = new \App\Models\SettingsModel();        
        $settings= $SettingsModel->get_settings();
        foreach($settings as $setup) {
            $this->settings[$setup->option_name]=$setup->option_value;
        }
    }


	//--------------------------------------------------------------------

}
