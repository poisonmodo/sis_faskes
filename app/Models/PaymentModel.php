<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table      = 'pembayaran';
    protected $primaryKey = 'id';

    public function get_parameter() {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                    * 
				FROM parameter_pembayaran
			   ";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }

    public function get_payment($skripsi_id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    pembayaran.*, parameter_pembayaran.param_name
                FROM pembayaran
                LEFT JOIN parameter_pembayaran ON parameter_pembayaran.id=pembayaran.parameter_id
                WHERE pembayaran.skripsi_id='".$skripsi_id."' 
                ORDER BY pembayaran.id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_payment_detail($skripsi_id,$id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                        pembayaran.*, parameter_pembayaran.param_name
                FROM pembayaran
                LEFT JOIN parameter_pembayaran ON parameter_pembayaran.id=pembayaran.parameter_id
                WHERE pembayaran.id='".$id."'
                AND pembayaran.skripsi_id='".$skripsi_id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
    
        return $results;
    }

    public function add_payment($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        if($data["tgl_bayar"]) {
            $tmp=strtotime($data["tgl_bayar"]);
            $data["tgl_bayar"] = date("Y-m-d",$tmp);
        }

        $sql ="INSERT INTO pembayaran SET
                    skripsi_id='".$data["skripsi_id"]."', 
                    tgl_bayar='".$data["tgl_bayar"]."',
                    parameter_id='".$data["param_id"]."',
                    biaya='".$data["biaya"]."',
                    created_at=NOW(),
                    updated_at=NOW();";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Pembayaran berhasil ditambahkan"
        );
        return $result;
    }

    public function edit_payment($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        if($data["tgl_bayar"]) {
            $tmp=strtotime($data["tgl_bayar"]);
            $data["tgl_bayar"] = date("Y-m-d",$tmp);
        }
        $sql ="UPDATE pembayaran SET
                    skripsi_id='".$data["skripsi_id"]."', 
                    tgl_bayar='".$data["tgl_bayar"]."',
                    parameter_id='".$data["param_id"]."',
                    biaya='".$data["biaya"]."',
                    updated_at=NOW() 
               WHERE id='".$data["id"]."';";
              
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Pembayaran berhasil diupdate"
        );
        return $result;
    }

    public function delete_payment($skripsi_id,$id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM pembayaran
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Pembayaran berhasil dihapus"
        );
        return $result;
    }
}
?>