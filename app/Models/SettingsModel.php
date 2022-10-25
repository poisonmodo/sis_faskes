<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table      = 'settings';
    protected $primaryKey = 'id';

    public function get_settings2()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM settings WHERE `status`=1";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }

    public function get_settings()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM settings";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }

    public function edit_settings($oname,$ovalue)
    {
        $is_error = 0;
        $db = \Config\Database::connect();
        $sql = "UPDATE settings SET 
                    option_value='" . $ovalue . "'
                WHERE option_name='".$oname."'";
        
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Settings berhasil diupdate"
        );
        return $result;
    }
}

